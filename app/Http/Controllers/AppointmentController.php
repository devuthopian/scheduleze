<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
//use App\AppointmentForm;
use App\Business;
use App\BusinessHours;
use App\PanelForm;
use App\LocationTime;
use App\Daysoff;
use App\UserDetails;
use App\Booking;
use App\AddonBookings;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Mail;
use App\Agents;
use Cookie;
use PDF;
use Crypt;

class AppointmentController extends Controller
{
    /**
    * @var User ID
    */
    protected $user_id = '';
    protected $business_id = '';
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // Set the user_id
        $this->user_id = session('id');
        $this->business_id = session('business_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $this->user_id;
        $businessinfo = Business::where('user_id', $this->user_id)->first();
        $ages = !empty($businessinfo->BuildingAges) ? $businessinfo->BuildingAges : '';
        $sizes = !empty($businessinfo->BuildingSizes) ? $businessinfo->BuildingSizes : '';
        $types = !empty($businessinfo->BuildingTypes) ? $businessinfo->BuildingTypes : '';
        $addons = !empty($businessinfo->Addons) ? $businessinfo->Addons : '';
        $Inspector = !empty($businessinfo->Inspector) ? $businessinfo->Inspector : '';

        if($businessinfo){
            $Location = $businessinfo->Location->pluck('name', 'id');
            $businessid = $businessinfo->id;
        }else{
            $Location = '';
        }

        return view('appointments.index', compact('businessinfo', 'ages', 'sizes', 'types', 'addons', 'Location', 'id', 'Inspector', 'businessid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function storebusinesshours(Request $request)
    {
        $data = Input::get();
        //dd(count($data['houropen']));
        for($i = 0; $i < count($data['houropen']); $i++) {
            if(isset($data['closed'][$i])){
                if ($data['closed'][$i] != 1) {
                    $totalstart=000;
                    $totalend=000;
                }
            }else {
                $totalstart = $data['houropen'][$i].$data['minuteopen'][$i];
                if ($data['amopen'][$i]=="PM") {
                    if ($data['houropen'][$i]!="12") {
                        $totalstart = ($totalstart + 1200);
                    }
                } else { //AM case
                    if ($data['houropen'][$i]=="12") {
                        $totalstart= "00".$data['minuteopen'][$i];
                    }
                }

                $totalend = $data['hourclose'][$i].$data['minuteclose'][$i];
                if ($data['amclose'][$i]=="PM") {
                    if ($data['hourclose'][$i]!="12") {
                        $totalend = ($totalend + 1200);
                    }
                } else { //AM case
                    if ($data['hourclose'][$i]=="12") {
                        $totalend= "00".$data['minuteclose'][$i];
                    }
                }
            }

            $BuildingTypes = BusinessHours::updateOrCreate(
                ['user_id' => $this->user_id,'day' => $i],
                [
                    'user_id' => $this->user_id,
                    'business' => $this->business_id, 
                    'starttime' => $totalstart, 
                    'endtime' => $totalend,
                    'day' => $i
                ]
            );
        }
        return redirect('/scheduleze/BusinessHours')->with('message','Successfully saved!');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function storedrivetime(Request $request)
    {
        $data = Input::get();

        foreach ($data['dt'] as $k => $drive) {
            foreach ($drive as $j => $time) {
                $sq['1'] = $k;
                $sq['2'] = $j;
                $sq['3'] = $time;
                $sq['4'] = $this->business_id;

                $sql = make_sql_value_insert($sq).", ";

                $sq['1']=$j;
                $sq['2']=$k;

                $sql .= make_sql_value_insert($sq).", ";
                $sql = substr($sql, 0, -2);
                
                $array = explode(',', $sql);
                $carry[] = array_chunk($array,4);
            }
           
        }
        $i = 0;
        foreach ($carry as $key => $value) {
            
            foreach ($value as $key => $val) {
                LocationTime::updateOrCreate(
                    ['id' => $i],
                    [
                        'user_id' => $this->user_id,
                        'business' => $this->business_id,
                        'start' => $val[0], 
                        'destination' => $val[1],
                        'time' => $val[2]
                    ]
                );
                $i++;
            }

        }
        return redirect('/scheduleze/DriveTime')->with('message','Successfully saved!');
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function storestoreoffdays(Request $request)
    {
        $data = Input::get();
        if ($data['reoccur'] == 1) {
            $i=0;
            foreach ($_POST['hourstart'] as $hr) {
                if (strlen($data['weekday'][$i."reoc"]) >= 1 ) {
                    $sql['day'] = $data['weekday'][$i."reoc"];
                    if($sql['day'] == 'nothing'){
                        $sql['day'] = 0;
                    }
                    $starttime = $hr.$data['minutestart'][$i];

                    if ($data['amstart'][$i]=="PM") {
                        if ($hr!="12") {
                        $starttime = ($starttime+1200);
                        }
                    } else {
                        if ($hr == "12") {
                            $starttime = 0;
                        }
                    }

                    if ($data['minuteend'][$i] == "00"){
                        $data['minuteend'][$i] = "59";
                        $data['hourend'][$i] = $data['hourend'][$i] - 1;
                    }
                    $endtime= $data['hourend'][$i].$data['minuteend'][$i];
                    if ($endtime == "1159" && $data['amend'][$i] == "AM"){
                        // this was a 1200AM posting, that would roll to the next day, so we have to say
                        $endtime = "2359";
                    }
                    if ($data['amend'][$i] == "PM") {
                        if ($data['hourend'][$i]!= "12") {
                            $endtime= $endtime+1200;
                        }
                    } else {
                        if ($data['hourend'][$i]=="12" && $endtime != "2359") {
                            $endtime= "00".$data['minuteend'][$i];
                        }
                    }

                    /***end insert format code***/

                    $sql['starttime'] = $starttime;
                    $sql['endtime'] = $endtime;
                    //$sql['user_id'] = $data['user_id'];
                    $sql['business'] = $this->business_id;
                    $sql['weeks'] = "";

                    $do="";
                    if (count($data['weeks'][$i]) > 0) {
                        foreach ($data['weeks'][$i] as $k => $week) {
                            if ($week) {
                                $sql['weeks'] .= $k;
                                $do="yes";
                            }
                        }
                    }
                    if ($do == "yes") {
                        $Daysoff = Daysoff::updateOrCreate(
                            ['id' => $i],
                            [
                                'user_id' => $this->user_id,
                                'business' => $this->business_id, 
                                'starttime' => $sql['starttime'], 
                                'endtime' => $sql['endtime'],
                                'weeks' => $sql['weeks'],
                                'day' => $sql['day']
                            ]
                        );
                    }
                }
                $i++;
            }

            return redirect('/scheduleze/Reoccurrence')->with('message','Successfully saved!');
        }
    }

    public function reciept($id='')
    {
        $id = Crypt::decrypt($id);
        $row = DB::table('bookings')->where([['id', '=', $id],['removed', '=', 0]])->first();

        if ($row->business == "0"){
            $row->business = $this->business_id;
        }

        $addss = get_addon_information($id);

        if (strlen($row->price) > 1){
            //$price = ("Cost: $".($row[price])." plus tax");
            $price = ("Cost: $".($row->price)."");
            $price2 = str_replace(",", "", $row->price);
            $price2 = str_replace("$", "", $price2);
            $price2 = str_replace(" ", "", $price2);
        }

        $siz = "Building: ".get_full_description($row->building_type, $row->building_size, $row->building_age);
        if ($row->building_type == 0){
            $siz = "Size: ".get_field('sizes', 'name', $row->size);
        }
        $inspect = "Inspector: ".get_field('users', 'name', $row->user_id);
        $location_name = get_field('locations', 'name', $row->location);


        $agent_name = "Agent Name: ".!empty($row->agent_name) ? $row->agent_name : ''."<br>";
        $mls = "MLS:  ".!empty($row->mls) ? $row->mls : ''."<br>";
        $entry_method = "Entry Method: ".!empty($row->entry_method) ? $row->entry_method : ''."<br>";
        $agent_phone = "Agent Phone: ".!empty($row->agent_phone) ? $row->agent_phone : ''."<br>";
        $agent_email = "Agent Email: ".!empty($row->agent_email) ? $row->agent_email : ''."<br>";
        $user_notes = "Note: ".!empty($row->user_notes) ? $row->user_notes : ''."<br>";
        $composite_address = "".strlen($row->address) > 2 ? $row->address : ''." ".$row->city." ".$row->state." ".$row->zip."<br>";
        $comp_email = "E-mail: ".!empty($row->email) ? $row->email : ''."";
        $comp_homephone = "Home phone: ".!empty($row->homephone) ? $row->homephone : ''."<br>";

        $paypal = get_field('business', 'paypal', $row->business);

        $paypal_link = '';
        if ($paypal == "1"){
            $paypal_email = get_field('business', 'paypal_email', $row->business);
            $paypal_link = '<a class="note_link" target=\"_blank\" href="https://secure.paypal.com/cgi-bin/webscr?cmd=_xclick&business='.$paypal_email.'&amount='.$price2.'&quantity=1&item_name=Inspection&return=http://www.scheduleze.com/receipt.php"><img height="33" width="184" src="images/logo6.gif" border="0" alt="Paypal accepts VISA and Mastercard"><br>You may choose to pay with Paypal</a><br><br>';
        }

        $start = date("g:i a, l, F jS", $row->starttime);
        $end = date("g:i a", $row->endtime);
        $addss['services'] = !empty($addss['services']) ? $addss['services'] : '';

        $list = "<div class='middleinfo'><b class='inspectAdd'>Inspection Address:</b>
            <div class=\"indent\"> ".$row->inspection_address." in ".$location_name."</div><br>
            <span class=\"note\"><b class='italianinspect'>Inspection booked for:</b><br></span>
            <div class=\"indent\"> ".$row->firstname." ".$row->lastname.
                $composite_address."
                    Contact phone: <a href='#'>".$row->dayphone." ".$comp_homephone. "</a><br>".
                "Email: ".$comp_email."
            </div><br>
            <span class=\"note\"><b class='italianinspect'>Appointment details:</b></span>
            <div class=\"indent\">".$start."<br>".
                $inspect."<br>".
                $siz."<br>".
                $price." ".$addss['services']."<br>".
                $agent_name." ".
                $agent_phone." ".
                $agent_email." ".
                $mls." ".
                $entry_method
            ."</div>".
            $user_notes."</div>"; //Approx. end time: $end<br>

        $business_name = get_field('business', 'name', $row->business);
        $business_email = get_field('business', 'email', $row->business);
        $business_phone = get_field('business', 'phone', $row->business);

        $timezone = get_field('business', 'timezone', $row->business);

        $time = time();
        $date_added = date("g:i a, F jS", ($row->added + $timezone));
        $date_printed = date("g:i a, F jS", ($time + $timezone));

        $pdf = PDF::loadView('appointments.receipt', compact('business_name', 'business_email', 'business_phone', 'date_added', 'date_printed', 'list', 'paypal_link', 'row', 'id'));
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookingform(Request $request)
    {
        //$id = Session::get('id');
        //$hashvalue = Session::get('hashvalue');

        $data = session('data');
        $bookingavailable = session('bookingavailable');
        if( $bookingavailable == null){

            session()->forget('data');
            $data = Input::get();
            session([ 'data' => $data]);
        }
        
        array_splice($data, 0, 1);
        $formdata = Input::get();

        if(!array_key_exists('inspector', $formdata)){
            $Inspectors = UserDetails::where([['business','=',$data['businessId']], ['removed','=','0']])->first();
            $formdata['inspector'] = $Inspectors->user_id;
        }
        array_splice($formdata, 0, 1);
        array_push($data, $formdata);        
        
        //session(['appointments' => $data]);
        //$username = session('username');
        $panel_id = session('panel_id');

        $PanelForm = PanelForm::where('panel_id', $panel_id)->first();

        return view('appointments.appointment_form', compact('PanelForm','data'));
    }

    public function storebookingappointment(Request $request)
    {
        $starttime = $request->input('starttime') + 1;
        //get endtime from db buffer
        $buffer = session('total_time');
        $endtime = (( $starttime + $buffer ) - 2); // minus 1 from the +1 on the starttime, and -1 again so that we are 6:59:59 instead of 7:00:00

        $start_date = date ("g:i a, F jS", $starttime);

        $data = Input::get();
        $added = time();

        $building_type = !empty($data['building_type']) ? $data['building_type'] : '';
        $building_size = !empty($data['building_size']) ? $data['building_size'] : '';
        $building_age = !empty($data['building_age']) ? $data['building_size'] : '';

        $total_price = session('total_price');

        $full_description = get_full_description($building_type, $building_size, $building_age);

        $location_name = get_field('locations', 'name', $data['location']);
        $inspector_name = get_field('users', 'name', $this->user_id);

        $adds_info = '';
        $addons_description = '';

        if(!empty($data['addon'])){
            $adds_info = format_addons($data['addon']);
            $addons_description = $adds_info['services'];
        }

        if ($total_price > 0){
            $print_price = ("Cost: $".($total_price)." plus tax");
        }


        if(verify_time($starttime, $endtime, $request->input('inspector')))
        {
            $Booking = Booking::create([
                'price' => $total_price,
                'user_id' => $request->input('inspector'),
                'location' => $request->input('location'),
                'building_type' => $request->input('building_type'),
                'building_size' => $request->input('building_size'),
                'building_age' => $request->input('building_ages'),
                'business' => $request->input('business'),
                'starttime' => $starttime,
                'endtime' => $endtime,
                'inspection_address' => $request->input('requiredInspection_Address'),
                'firstname' => $request->input('requiredFirstname'),
                'lastname' => $request->input('requiredLastname'),
                'address' => $request->input('Current_Address'),
                'city' => $request->input('City'),
                'state' => $request->input('state'),
                'zip' => $request->input('ZIP'),
                'email' => $request->input('requiredEmail'),
                'homephone' => $request->input('requiredPhone'),
                'dayphone' => $request->input('phone2'),
                'agent_name' => $request->input('Agent_Name'),
                'agent_phone' => $request->input('Agent_Phone'),
                'agent_email' => $request->input('Agent_Email'),
                'entry_method' => $request->input('entry_method'),
                'mls' => $request->input('mls'),
                'notes' => $request->input('notes')
            ]);

            $addon = session('addon');        
            if (is_array($addon)){
                foreach ($addon as $addn){

                    $AddonBookings = AddonBookings::create([
                        'addon' => $addn,
                        'booking' => $request->input('business')
                    ]);
                }
            }

            if((!Cookie::get('agent_id')) || ($request->input('remember_agent') == "1")) {
                $cookie_id = md5(microtime());
                $AddonBookings = Agents::create([
                    'name' =>  $request->input('Agent_Name'),
                    'phone' => $request->input('Agent_Phone'),
                    'email' => $request->input('Agent_Email'),
                    'cookie_id' => $cookie_id,
                    'remember' => $request->input('remember_agent'),
                    'business' => $request->input('business')
                ]);

                $expire = time() + 60*60*24*180;

                Cookie::queue('agent_id', $cookie_id, $expire);
            }

                /*setcookie("agent_id", $ag[cookie_id], $expire, "/", ".scheduleze.com");*/ //old method for saving cookie

            $clean_addons = '';
            if (strlen($data['addons_description']) > 2){
                $clean_addons = "&nbsp;";
                $clean_addons .= str_replace("<br>", "", $data['addons_description']);
                $clean_addons .= "<br>";
            }


   
            $mls2 = "<br>&nbsp;MLS:".!empty($data['mls']) ? $data['mls'] : ''."";
            $entry_method2 = "&nbsp;Entry Method: ".!empty($data['entry_method']) ? $data['entry_method'] : ''."";
        
            $agent_name2 = "<br>Agent Information:<br>&nbsp;Agent Name: ".!empty($data['Agent_Name']) ? $data['Agent_Name'] : ''."<br>";
            $agent_phone2 = "&nbsp;Agent Phone: ".!empty($data['Agent_Phone']) ? $data['Agent_Phone'] : ''."<br>";
            $agent_email2 = "&nbsp;Agent Email: ".!empty($data['Agent_Email']) ? $data['Agent_Email'] : ''."<br>";

            $user_notes2 = "<br>Note: ".!empty($data['notes']) ? $data['notes'] : ''."<br>";

            $timezone = get_field('business', 'timezone', $data['business']);
            $business_name = session('business_information.name');

            /*$email_body = "$includes[email_header]";
            if (strlen($includes[email_header])>3){
                $email_body .= "\n\n";
            }*/

            $email_body = "Inspection Address: ".$data['requiredInspection_Address']." in ".$location_name."<br><br>";
            $email_body .= "Inspection Booked for:<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;".$data['requiredFirstname']." ".$data['requiredLastname']."<br>";

            if(!empty($data['Current_Address'])){
                $email_body .= "&nbsp;&nbsp;&nbsp;".$data['Current_Address']."<br>&nbsp;".$data['City']." ".$data['state']."  ".$data['ZIP']."<br>";
            }

            $email_body .= "&nbsp;&nbsp;&nbsp;Cell phone: ".$data['phone2']."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Work phone: ".$data['requiredPhone']."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;E-mail: ".$data['requiredEmail']."<br><br>";
            $email_body .= "Appointment time: ".$start_date."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Inspector: ".$inspector_name."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Appointment Type: ".$full_description."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;".$print_price."<br>";
            $email_body .= "".$clean_addons."<br><br>";

            $email_body .= "Agent Information: <br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Agent Name: ".$agent_name2."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Agent Phone: ".$agent_phone2."<br>";
            $email_body .= "&nbsp;&nbsp;&nbsp;Agent Email: ".$agent_email2."<br><br>";

            $attachment = Business::select('email_attachment')->where('id', $request->input('business'))->first();
            $start = date("g:i a, l, F jS", $data['starttime']);

            if(!empty($user_notes2)){
                $email_body .= "Note: ".$user_notes2."<br><br>";
            }

            /* $email_body .= "".$entry_method2."";
            $email_body .= "".$mls2."";
            $email_body .= "".$user_notes2."";*/

            $email_body .= ("<br>Reservation made at: ".date("g:i a, F jS", ($added + $timezone)));
            $email_body .= "<br>Thanks for using ".$business_name."!<br>";
            //$email_body .= "".$includes[email_footer]."\n\n";
            
            $email_body = stripslashes($email_body);
            
            $inspector_email = !empty(get_field('users', 'email', $request->input('inspector'))) ? get_field('users', 'email', $request->input('inspector')) : '';

            $inspector_additional_email = !empty(get_field('users_details', 'email2', $request->input('inspector'))) ? get_field('users_details', 'email2', $request->input('inspector')) : $inspector_email;

            if ($inspector_email != session('business_information.email'))
            {
                $business_info_email = !empty(session('business_information.email')) ? session('business_information.email') : $inspector_email;
            }

            $business_info_email2 = !empty(session('business_information.email2')) ? session('business_information.email2') : $inspector_email;

            $emails = [$inspector_email, $inspector_additional_email, $business_info_email, $business_info_email2];

            $text = "<h2>You have received an on-line booking for ".$start." with the following information:</h2><br> <h2>IMPORTANT NOTICE:</h2> <i>A copy of our Inspection Agreement is attachment for your review prior to the inspection.</i><br>";

            Mail::send(['html' => 'appointments.mail'], ['email_body' => $email_body, 'emails' => $emails, 'text' => $text] , function($message) use ($email_body, $emails, $text) {
                $message->to($emails)->subject('On-line inspection booking');
                $message->from('support@scheduleze.com', 'Scheduleze');
                $message->replyTo('noreply@scheduleze.com', 'no Reply');
                //$message->setBody("You have received an on-line inspection booking with the following information:\n\n".$email_body."", 'text/html'); // for HTML rich messages;
            });

            if (!empty($data['requiredEmail'])){ //reasonably valid email address for the client

                $text = "<h2>You have requested a inspection for ".$start." with the following details:</h2><br> <h2>IMPORTANT NOTICE:</h2> <i>A copy of our Inspection Agreement is attachment for your review prior to the inspection.</i><br>";

                Mail::send(['html' => 'appointments.mail'], ['start' => $start, 'email_body' => $email_body, 'data' => $data, 'business_name' => $business_name, 'attachment' => $attachment, 'text' => $text] , function($message) use ($email_body, $data, $business_name, $start, $Booking, $attachment, $text) {
                    $message->to($data['requiredEmail'])->subject('+ On-line inspection booking at '.$start.' - #'.$Booking->id.'');
                    $message->from('support@scheduleze.com', $business_name);
                    $message->replyTo('noreply@scheduleze.com', 'no Reply');
                    $message->attach(public_path().'/attachments/'.$data['business'].'/'.$attachment->email_attachment);
                    //$message->setBody("You have requested an inspection with the following details:<br>", 'text/html'); // for HTML rich messages;
                });
            }
            
            if (!empty($data['Agent_Email'])){ //reasonably valid email address for the agent
                $text = "<h2>An on-line inspection has been requested for ".$start." with the following details:</h2><br> <h2>IMPORTANT NOTICE:</h2> <i>A copy of our Inspection Agreement is attachment for your review prior to the inspection.</i><br>";

                Mail::send(['html' => 'appointments.mail'], ['start' => $start, 'email_body' => $email_body, 'data' => $data, 'inspector_email' => $inspector_email, 'text' => $text] , function($message) use ($email_body, $inspector_email, $data, $business_name, $start, $Booking, $text) {
                    $message->to($data['Agent_Email'])->subject('+ On-line booking at '.$start.' - #'.$Booking->id.'');
                    $message->replyTo('noreply@scheduleze.com', 'no Reply');
                    $message->from('support@scheduleze.com', $business_name);
                    //$message->setBody('', 'text/html'); // for HTML rich messages;
                });
            }

            return redirect('/appointment/receipt/'.Crypt::encrypt($Booking->id).'');
        }

        return redirect('/scheduling_solutions')->with('message', 'That time has just been booked by someone else.');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function bookingavailable(Request $request)
    {
        //$id = Session::get('id');
        //$hashvalue = Session::get('hashvalue');
        $data = Input::get();
        session([ 'data' => $data, 'bookingavailable' => 'yes']);

        $business_id = $data['businessId'];
        //session(['appointments' => $data]);
        //$username = session('username');
        $panel_id = session('panel_id');

        $PanelForm = PanelForm::where('panel_id', $panel_id)->first();
        //$business_id = session('business_id');
        $Inspectors = UserDetails::where([['business', '=', $business_id],['removed', '=', '0']])->get();

        return view('appointments.availability', compact('PanelForm', 'data', 'Inspectors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
