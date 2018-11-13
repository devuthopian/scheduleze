<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Booking;
use App\BusinessTypes;
use App\BusinessHours;
use App\Daysoff;
use App\LocationTime;
use App\PanelTemplate;
use App\Location;
use App\UserDetails;
use App\Reports;
use App\ServiceContent;
use Illuminate\Support\Facades\Input;
use PDF;
use DB;
use Validator;
use Auth;
use Crypt;
use File;

class SchedulezeController extends Controller
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
     * Show the application homepage.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('scheduleze.welcome');
    }

    public function terms_policy()
    {
        return view('scheduleze.service_agreement');
    }

    public function mapmyday($location = '', $first = '', $last = '', $id = '')
    {
        $id = $this->user_id;
        $first = strtotime('today midnight');
        $last   = strtotime("tomorrow", $first) - 1;        

        $data = Input::get();
        $businessID = $this->business_id;

        if(!empty($data)){
            if(empty($data['users_details'])){
                $id = $this->user_id;
            }else{
                $id = $data['users_details'];
            }

            $first = "12:00 AM ".$data['monthstart'][0]."/".$data['daystart'][0]."/".$data['yearstart'][0]."";
            //echo "first: $first<br>";
            $first = strtotime($first);
            $last = "11:59 PM ".$_POST['monthend'][1]."/".$_POST['dayend'][1]."/".$_POST['yearend'][1]."";
            //echo "last:$last<br>";
            $last = strtotime($last);

           /* $first = $data['first'];
            $last = $data['last'];*/
        }        

        $administration = get_field('users_details', 'administrator', $this->user_id);

        if(!empty($location)){

            $loca = Crypt::decrypt($location);

            $arr = explode(",", $loca, 2);
            $firstlocation = $arr[0];

            //$tt = Booking::where([['inspection_address', 'like', '%'.$firstlocation.'%'],['endtime', '>', $first],['starttime', '<', $last],['removed', '=', 0]])->orderBy('type', 'ASC')->orderBy('starttime', 'ASC')->first();

            $tt = Booking::where([['inspection_address', 'like', '%'.$firstlocation.'%'],['removed', '=', 0]])->orderBy('type', 'ASC')->orderBy('starttime', 'ASC')->first();

            $jobname = $tt->building_types;
            if($tt->zip){
                $inspection_address = $tt->inspection_address.','.$tt->zip;
            }else{
                $inspection_address = $tt->inspection_address;
            }
        }else{

            if($id == 'all'){
                $tt = Booking::where([['business', '=', $this->business_id],['endtime', '>', $first],['starttime', '<', $last],['removed', '=', 0]])->orderBy('type', 'ASC')->orderBy('starttime', 'ASC')->get();
            }else{
                $tt = Booking::where([['endtime', '<', $last],['user_id', '=', $id],['starttime', '>', $first],['removed', '=', 0]])->orderBy('type', 'ASC')->orderBy('starttime', 'ASC')->get();
            }

            if(count($tt) > 0){
                foreach ($tt as $key) {
                    $jobname[] = $key->building_types;
                    $loca[] = $key->locations;
                    $inspection_address[] = $key->inspection_address.','.$key->zip;
                }
            }else{
                $loca = '';
                $jobname = '';
            }
            //$location = '';
        }
        return view('scheduleze.mapmyday', compact('loca', 'jobname', 'first', 'last', 'administration', 'id', 'businessID', 'inspection_address'));
    }

    public function changeContent()
    {
        $data = Input::get();
        $default = !empty($data) ? $data['txtIndustries'] : '1';
        
        $BusinessTypes = BusinessTypes::where('id', $default)->first();
        $ServiceContent = ServiceContent::where([['business', '=', $this->business_id], ['business_type_id', '=', $default]])->first();

        return view('profiles.ServiceContent', compact('BusinessTypes', 'ServiceContent'));
    }

    public function confirm_status()
    {
        return view('auth.email_confirm');
    }

    public function EmailAttachment()
    {
        $business = Business::where('id', $this->business_id)->first();
        $name = !empty($business->email_attachment) ? $business->email_attachment : '';
        return view('profiles.EmailAttachment', compact('name'));
    }

     /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */

    public function scheduling_solutions()
    {
        if(Auth::id()){
            return redirect('/scheduleze/booking/appointment');
        }
        //auth()->logout();
        return view('scheduleze.scheduling_solutions');
    }

    public function scheduling_faq()
    {
        return view('scheduleze.schedule_faq');
    }

    public function ZigZag()
    {
        $id = $this->user_id;
        $businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();

        //zigzag stuff
        $z = get_field('users_details', 'zigzag', $id);
        $zigpop = get_field('users_details', 'zzamount', $id);
        $zigpop = get_zigpop($zigpop);

        if ($z==1) {
            $z = "checked";
        } else {
            $z = "";
        }

        return view('zigzag.zigzag', compact('businesshours', 'zigpop', 'z'));
    }

    public function storeZigZag(Request $request)
    {
        $data = Input::get();
        $id = $this->user_id;

        if ($data['trigger'] == 1) {
            if ($data['zigzag'] == 1) {
                $act = "Enabled";
                $zigzag = $data['zigzag'];
                $zzamount = $data['zigpop'];
            } else {
                $act = "Disabled";
                $zigzag = 0;
                $zzamount = 0;
            }

            $UserDetails = UserDetails::updateOrCreate(
                ['user_id' => $id],
                [
                    'zigzag' => $zigzag,
                    'zzamount' => $zzamount
                ]
            );

            //$message = 'Zigzag Control'.$act;
        }

        return redirect('/scheduleze/zigzag')->with('message', trans('scheduleze.MessageforZigzagChanges'));
    }

    /*public function ListBlockout()
    {
        $id = session('id');
        $first = time();
        $last = $first + 1209500;

        return view('appointments.blockouts', compact('id', 'first', 'last'));
    }*/

    public function dayticket($userid = null, $days = null, $start = null)
    {
        $pdf = PDF::loadView('appointments.dayticket', compact('userid','days','start'));
        return $pdf->stream();
        //return $pdf->download('invoice.pdf');
        //return view('appointments.dayticket', compact('userid', 'days', 'start'));
    }

    /**
    * Show the application business hours.
    *
    * @return \Illuminate\Http\Response
    */

    public function BusinessHours()
    {
        $data = Input::get();
        if(!empty($data['users_details']) && isset($data['users_details'])){
            $id = $data['users_details'];
        }else{
            $id = $this->user_id;
        }
        
        $businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();
        return view('appointments.business_hours', compact('id', 'businesshours'));
    }

    public function BookingFilter(Request $request, $form = '')
    {
        $data = Input::get();

        if(empty($data['users_details'])){
            $id = $this->user_id;
        }else{
            $id = $data['users_details'];
        }

        $flag = 0;
        if($form == 'AdvanceFilter'){

            $id = 'all';

            $first = time();
            $last = $first + 1209500;

            $bookings = DB::table('bookings')->select('bookings.id', 'bookings.business', 'bookings.price', 'bookings.inspection_address', 'bookings.firstname', 'bookings.price', 'bookings.lastname', 'bookings.agent_name', 'bookings.building_type', 'bookings.building_size', 'bookings.building_age', 'bookings.starttime', 'bookings.endtime', 'bookings.user_id', 'bookings.type', 'bookings.notes', 'bookings.location', 'bookings.user_notes', 'bookings.agent_email', 'bookings.agent_phone', 'bookings.email', 'bookings.homephone', 'bookings.dayphone', 'building_types.name', 'building_ages.name', 'building_sizes.name');

            $bookings->leftJoin('building_types', 'bookings.business', '=', 'building_types.business');
            $bookings->leftJoin('building_ages', 'bookings.business', '=', 'building_ages.business');
            $bookings->leftJoin('building_sizes', 'bookings.business', '=', 'building_sizes.business');
            $bookings->leftJoin('locations', 'bookings.business', '=', 'locations.business');

            $bookings->where(function ($query) use ($first, $last) {
                $query->where('endtime', '>', $first)->where('starttime', '<', $last);
            });

            if(!empty($data['txtAddress']))
            {
                $bookings->where(function ($query) use ($data) {
                    $query->where('inspection_address', 'like', '%'.$data['txtAddress'].'%')->orWhere('locations.name', 'like', '%'.$data['txtAddress'].'%');
                });
            }


            if(!empty($data['txtClientName'])){

                $bookings->where(function ($query) use ($data) {
                    $query->where('firstname', 'like', '%'.$data['txtClientName'].'%')->orWhere('lastname', 'like', '%'.$data['txtClientName'].'%');
                });

                /*$tt->where('firstname', 'like', '%'.$data['txtClientName'].'%')
                ->orWhere('lastname', 'like', '%'.$data['txtClientName'].'%');*/

                /*$whereArr[] = ['firstname', 'like', '%'.$data['txtClientName'].'%'];
                $whereArr[] = ['lastname', 'like', '%'.$data['txtClientName'].'%'];*/
            }

            if(!empty($data['txtAgentName'])){
                $bookings->where('agent_name', 'like', '%'.$data['txtAgentName'].'%');
            }

            if(!empty($data['txtKeyword'])){

                $bookings->where(function ($query) use ($data) {
                    $query->where('inspection_address', 'like', '%'.$data['txtKeyword'].'%')->orWhere('firstname', 'like', '%'.$data['txtKeyword'].'%')->orWhere('bookings.price', 'like', '%'.$data['txtKeyword'].'%')->orWhere('lastname', 'like', '%'.$data['txtKeyword'].'%')->orWhere('building_types.name', 'like', '%'.$data['txtKeyword'].'%')->orWhere('building_ages.name', 'like', '%'.$data['txtKeyword'].'%')->orWhere('building_sizes.name', 'like', '%'.$data['txtKeyword'].'%')->orWhere('bookings.user_notes', 'like', '%'.$data['txtKeyword'].'%')->orWhere('bookings.notes', 'like', '%'.$data['txtKeyword'].'%');
                });
            }

            $tt = $bookings->where('bookings.removed', 0)->groupBy('firstname')->get();

            $flag = 1;

        }else{
            if (isset($data['daystart']) != "" && isset($_POST['dayend']) != "") {

                $first = "12:00 AM ".$data['monthstart'][0]."/".$data['daystart'][0]."/".$data['yearstart'][0];
                $first = strtotime($first);
                $last = "11:59 PM ".$data['monthend'][1]."/".$data['dayend'][1]."/".$data['yearend'][1];
                $last = strtotime($last);
                //$vars = "&first=$first&last=$last&inspector=$_POST[inspector]";

            } elseif ($data['first']!="") {

                $first = $data['first'];
                $last = $data['last'];

            } elseif (session('first_time') != "") {

                $first = session('first_time');
                $last = session('last_time');

            } elseif ($first=="") {

                $first = time();
                $last = $first + 1209500;

            } elseif (strlen($first) > 9) {

                //$vars = "&first=$first&last=$last&inspector=$_POST[inspector]";

            }

            session(['first_time' => $first]);
            session(['last_time' => $last]);

            $tt = array();
        }
        $administration = get_field('users_details', 'administrator', $this->user_id);

        return view('appointments.bookings', compact('id', 'first', 'last', 'order', 'inc', 'form', 'administration', 'tt', 'flag'));
    }

    public function storeBlockout(Request $request, $form)
    {
        $data = Input::get();
        check_permission($data['users_details']);

        $location = $data['location'];

        $starttime = $data['hourstarttime'][0].":".$data['minutestarttime'][0]." ".$data['amstarttime'][0]." ".$data['monthstarttime'][0]."/".$data['daystarttime'][0]."/".$data['yearstarttime'][0];

        $starttime = strtotime($starttime) + 1;

        if(isset($data['sameday'])){
            if ($data['sameday'] == 1) {
                $endtime = $data['hourendtime'][1].":".$data['minuteendtime'][1]." ".$data['amendtime'][1]." ".$data['monthstarttime'][0]."/".$data['daystarttime'][0]."/".$data['yearstarttime'][0];
            }
        }
        else {
            $endtime = $data['hourendtime'][1].":".$data['minuteendtime'][1]." ".$data['amendtime'][1]." ".$data['monthendtime'][1]."/".$data['dayendtime'][1]."/".$data['yearendtime'][1];
        }

        $endtime = strtotime($endtime);
        
        if ($starttime > $endtime){
            //$_SESSION[warning] = "Start time occurs after the specified endtime.  End time set to 1 hour after start time.  Edit to correct.";
            $starttime = $starttime;
            $endtime = $starttime + 3600;
        } else {
            $starttime = $starttime;
            $endtime = $endtime;
        }

        $notes = $data['notes'];
        $users_details = $data['users_details'];
        $business = session('business_id');
        $type = 1; //this is a blockout afterall

        $added = time();

        $Booking = Booking::updateOrCreate(
        ['id' => $data['target']],
        [
            'user_id' => $users_details,
            'business' => $business,
            'starttime' => $starttime,
            'endtime' => $endtime,
            'notes' => $notes,
            'type' => $type,
            'location' => $location
        ]);

        $blockId = $Booking->id;

        return redirect('/scheduleze/booking/blockouts')->with('message', trans('scheduleze.MessageforBlockout'));
    }

    /**
    * Show the application business appointments.
    *
    * @return \Illuminate\Http\Response
    */
    public function Bookings($form, $userid = null)
    {
        if(empty($userid)){
            $id = $this->user_id;
        }else{
            $id = $userid;
        }

        $administration = session('administrator');
        if($administration == null || empty($administration)){
            $administration = get_field('users_details', 'administrator', $id);
        }

        $first = time();
        $last = $first + 1209500;

        $tt = array();

        $flag = 0;

        /*$businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();*/
        return view('appointments.bookings', compact('id', 'first', 'last', 'form', 'administration', 'tt', 'flag'));
    }

    public function Documents()
    {
        $id = $this->user_id;

        $last = time();
        $first = $last - 1209500;

        return view('appointments.documents', compact('id', 'first', 'last'));
    }

    public function DocumnetFilter(Request $request)
    {
        $data = Input::get();
        $id = $data['users_details'];
            
        $first = "12:00 AM ".$data['monthstart'][0]."/".$data['daystart'][0]."/".$data['yearstart'][0]."";
        //echo "first: $first<br>";
        $first = strtotime($first);
        $last = "11:59 PM ".$_POST['monthend'][1]."/".$_POST['dayend'][1]."/".$_POST['yearend'][1]."";
        //echo "last:$last<br>";
        $last = strtotime($last);

        return view('appointments.documents', compact('id', 'first', 'last'));
    }

    public function DocumnetReport($bookingid)
    {
        $booking_inspector = get_field ('bookings', 'user_id', $bookingid);   
        check_permission($booking_inspector);
        
        $inspector_email = get_field('users', 'email', $booking_inspector);
        $inspector_email2 = get_field('users_details', 'email2', $booking_inspector);
        $firstname = get_field('users_details', 'name', $booking_inspector);
        $lastname = get_field('users_details', 'lastname', $booking_inspector);
        $address = ucfirst(get_field('bookings', 'inspection_address', $bookingid));
        $loc = get_field('bookings', 'location', $bookingid);
        $location = ucfirst(get_field('locations', 'name', $loc));
        $email = get_field('bookings', 'email', $bookingid);
        $agent_email = get_field('bookings', 'agent_email', $bookingid);

        $Report = array('inspector_email' => $inspector_email, 'inspector_email2' => $inspector_email2, 'firstname' => $firstname, 'lastname' => $lastname, 'address' => $address, 'location' => $location, 'email' => $email, 'agent_email' => $agent_email);

        return view('appointments.postreport', compact('bookingid', 'Report'));
    }

    public function SaveReport(Request $request)
    {
        $data = Input::get();
        $validatedData = Validator::make($request->all(), [
            'userfile' => 'required| mimes:jpeg,pdf,doc,docx | max:1000'
        ]);

        if ($validatedData->fails()) {
            return redirect('BuildingTypess')->withErrors($validatedData)->withInput();
        }

        $md5 = md5(microtime());
        $added = time();

        $expire = (($data['expire'] * 86400) + $added);

        $Reports = Reports::updateOrCreate(
            ['booking' => $data['booking']],
            [
                'booking' => $data['booking'],
                'code' => substr($md5, 5, 8),
                'summary' => $data['summary'],
                'memo' => $data['memo'],
                'added' => $added,
                'expire' => $expire
            ]
        );

        $imageName = $Reports->id . '.' . 
        $request->file('userfile')->getClientOriginalExtension();

        $request->file('userfile')->move(
            base_path() . '/public/images/reports/', $imageName
        );
        
        $Reports = Reports::updateOrCreate(
            ['booking' => $data['booking']],
            [
                'pdf' => $imageName
            ]
        );

        return redirect('/scheduling_solutions')->with('message', trans('scheduleze.MessageforReport'));
    }

    public function ViewReport($id='', $go='', $code='')
    {
        if ( (!is_numeric($id)) or ((strlen($go)<5)) ) {
            return redirect('/scheduleze/documents')->with('message', trans('scheduleze.MessageforNotAllowed'));
        } else {

            $now = time();
            $row = DB::table('reports')->where('id', $id)->first();
            //$sql = "select * from reports where id='$_GET[id]'";

            $bus = get_field('bookings', 'business', $row->booking);
            $email = get_field('business', 'public_email', $bus);
            $phone = get_field('business', 'phone', $bus);       
        }

        if(isset($go)){
            if ($row->code == $go) {
                if (handoff_file($id)){
                    $aug = $row->views + 1;
                    $row = DB::table('reports')->where('id', $row->id)->update(['views' => $aug]);
                } else {
                    $message = session('warning');
                }
            }
        }else{

            $html = '';
            if ($row->code != $code) {
                $html = "Your link is not correct. Please contact us.";
            } elseif ($row->expire < $now) {
                $html = "Your report has expired.";
            }
            else {
                //spit out the link
                $date = date("F j, Y", $row->added);
                
                
                $row->memo = stripslashes($row->memo);
                $row->summary  = stripslashes($row->summary);
            }
        }

        return view('appointments.viewreport', compact('row', 'id', 'code', 'now', 'message'));
    }

    public function UpdateBooking(Request $request, $id)
    {
        $data = Input::get();
        //dd($data);
        $getstend = DB::table('bookings')->select('starttime', 'endtime')->where('id', $id)->first();

        $starttime = $data['hourstarttime'][0].":".$data['minutestarttime'][0]." ".$data['amstarttime'][0]." ".$data['monthstarttime'][0]."/".$data['daystarttime'][0]."/".$data['yearstarttime'][0];

        $temp_start = strtotime($starttime) + 1;

        $endtime = $data['hourendtime'][1].":".$data['minuteendtime'][1]." ".$data['amendtime'][1]." ".$data['monthendtime'][1]."/".$data['dayendtime'][1]."/".$data['yearendtime'][1];

        $temp_end = (strtotime($endtime) - 1);
        
        $flash = 0;
        if ($temp_start > $temp_end){
            $flash = 1;

            $starttime = $getstend->starttime;
            $endtime = $getstend->endtime;
            //$_SESSION[warning] = "Start time occurs after the specified endtime.  No change made to start or end times, other edits executed successfully";
        } else {
            $starttime = $temp_start;
            $endtime = $temp_end;
        }

        $building_type = $data['building_type'];

        $building_size = 0;
        if (isset($data['building_size'])){
            if($data['building_size'] > 0){
                $building_size = $data['building_size'];
            }
        }

        $building_age = 0;
        if (isset($data['building_age']) > 0){
            if($data['building_age'] > 0){
                $building_age = $data['building_age'];
            }
        }

        $addons = '';
        if(isset($data['addon'])){
            if (is_array($data['addon'])){
                $addons = $data['addon'];
            }
        }

        $this_total_price = get_total_price($building_type, $building_size, $building_age, $data['location'], $addons);

        if (isset($data['quote_override'])){
            if($data['quote_override'] == 1){
                $this_total_price = str_replace("$", "", $_POST['price']);
            }
        }

        $inspection_address = $data['Inspection_Address'];
        $firstname = $data['Firstname'];
        $lastname = $data['Lastname'];
        $address = $data['Current_Address'];
        $state = $data['State'];
        $dayphone = $data['Phone'];
        $homephone = $data['phone2'];
        $city = $data['City'];
        $zip = $data['ZIP'];
        $email = $data['Email'];
        $agent_name = $data['agent_name'];
        $agent_phone = $data['agent_phone'];
        $agent_email = $data['agent_email'];
        $listing_agent = $data['Listing_Agent'];
        $listing_office = $data['Listing_Office'];
        $listing_phone = $data['Listing_Phone'];
        $location = $data['location'];
        $mls = $data['mls'];
        $entry_method = $data['other_entry_method'];
        $price = $this_total_price;
        //$inspector = $data['inspector'];
        $business = session('business_id');

        $notes = $data['notes'];
        $user_notes = $data['user_notes'];
        $type = 0;

        $inpector_attempt_hit = get_field("bookings", "user_id", $data['target']);

        if (check_permission($inpector_attempt_hit)){
            $edited = time();
        }

        //$sql = make_sql($sq, "bookings", "update", "id", "$_POST[target]");

        $Booking = Booking::updateOrCreate(
            ['id' => $data['target']],
            [
                'inspection_address' => $inspection_address,
                'business' => $business,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'address' => $address,
                'homephone' => $homephone,
                'dayphone' => $dayphone,
                'email' => $email,
                'city' => $city,
                'state' => $state,
                'zip' => $zip,
                'agent_name' => $agent_name,
                'agent_phone' => $agent_phone,
                'agent_email' => $agent_email,
                'listing_agent' => $listing_agent,
                'listing_office' => $listing_office,
                'listing_phone' => $listing_phone,
                'entry_method' => $entry_method,
                'mls' => $mls,
                'user_notes' => $user_notes,
                'starttime' => $starttime,
                'endtime' => $endtime,
                'location' => $location,
                'building_type' => $building_type,
                'building_size' => $building_size,
                'building_age' => $building_age,
                'price' => $price,
                'type' => $type,
                'notes' => $notes,
                'edited' => $edited
            ]
        );

        if(isset($data['addon'])){
            if (is_array($data['addon'])){

                $delete = DB::table('addons_bookings')->where('booking', $data['target'])->delete();

                foreach ($data['addon'] as $addn){
                    DB::table('addons_bookings')->insert(
                        ['addon' => $addn, 'booking' => $data['target']]
                    );
                }
            }
        }

        if($flash == 1){
            return redirect('/scheduleze/booking/edit/'.$id)->withErrors(trans('scheduleze.AppointmentWarning'));
        }

        return redirect('/scheduleze/booking/appointment')->with('message', trans('scheduleze.UpdateAppointment'));
    }

    public function EditBooking(Request $request, $id)
    {
        $userid = $this->user_id;
        $booking = Booking::where('id', $id)->first();

        $location_popup = get_location_popup($booking->location);

        $business = $this->business_id; //get business id from session
        $type_pop = get_pricing_popup($business, "building_types", "building_type", "smallselect", $booking->building_type);
        $size_pop = get_pricing_popup($business, "building_sizes", "building_size",  "smallselect", $booking->building_size);
        $age_pop = get_pricing_popup($business, "building_ages", "building_age", "smallselect", $booking->building_age);

        $inspector_popup = get_inspector_popup('name', $userid);

        $start_popup = get_time_popup ($booking->starttime, $designate = "", 1, 1, 1, 1, 1, 1, 'starttime');
        $end_popup = get_time_popup (($booking->endtime + 2), $designate = "1", 1, 1, 1, 1, 1, 1, 'endtime');


        //$ss = "select addon from addons_bookings where booking = '$row[id]'";
        $addons_edit = DB::table('addons_bookings')->select('addon')->where('booking', $booking->id)->get()->toArray();

        //$addons_edit = $l->pull_flat_multi($ss);
        if(empty($addons_edit)){
            $addons_edit = '';
        }else{
            $c=0;
            foreach ($addons_edit as $value) {
                $addons_edit[$c] = $value->addon;
                $c++;
            }
        }

        $add_on_checkboxes = get_addon_checkboxes("addons", "id", "name", "addon", "", "rank", "ASC", "40", $addons_edit, 3);

        $groupdata = array('userid' => $userid, 'booking' => $booking, 'location_popup' => $location_popup, 'type_pop' => $type_pop, 'size_pop' => $size_pop, 'age_pop' => $age_pop, 'start_popup' => $start_popup, 'end_popup' => $end_popup, 'add_on_checkboxes' => $add_on_checkboxes, 'id' => $id);

        
        return view('appointments.editbooking', compact('groupdata', 'inspector_popup'));
    }

    public function DeleteBooking($id)
    {
        $type = get_field('bookings', 'type', $id);
        $affected_inspector = get_field('bookings', 'user_id', $id);
        check_permission($affected_inspector);

        if ($type == "1"){
            $appoint = "blockout";
        } else {
            $appoint = "booking";
        }       

        $update = Booking::where('id', $id)->update(['removed' => 1]);

        if($update == 1){
            return back()->with('message', $appoint.' Removed!');
        }

        return back()->with('message', trans('scheduleze.MessageforDeleteBooking'));

    }

    public function Blockout($form, $blockId = null)
    {
        $id = $this->user_id;
        $first = time();
        $last = $first + 1209500;

        $row = '';
        if(!empty($blockId)){
            $row = Booking::select('starttime', 'endtime' ,'notes', 'user_id')->where('id', $blockId)->first();
            session(['affected_inspector' => $row->user_id]);
            check_permission($row->user_id);
        }

        return view('appointments.arrangeblockouts', compact('id', 'first', 'last', 'form', 'row', 'blockId'));
    }

    /**
    * Show the application drivetime.
    *
    * @return \Illuminate\Http\Response
    */

    public function drivetime()
    {
        $business_id = $this->business_id;
        $LocationTime = LocationTime::where([['business', '=', $business_id],['removed', '=', 0]])->orderBy('start', 'ASC')->get()->toArray();
        $Location = Location::where([['business','=', $business_id],['removed','=',0]])->get()->toArray();
        $locs2 = $Location;
        return view('appointments.drivetimes', ['LocationTime' => $LocationTime, 'locs2' => $locs2, 'Location' => $Location]);
    }

    /**
    * Show the application Blockouts hours.
    *
    * @return \Illuminate\Http\Response
    */

    public function blockouts_occurance()
    {
        $data = Input::get();

        if(isset($data['users_details'])){
            $id = $data['users_details'];
        }else{
            $id = $this->user_id;
        }

        $Daysoff = Daysoff::where([['user_id', '=', $id],['removed', '=', 0]])->get();
        return view('appointments.reoccurrence', compact('id', 'Daysoff'));
    }

     /**
     * Show the application success stories page.
     *
     * @return \Illuminate\Http\Response
     */

    public function success_stories()
    {
        return view('scheduleze.success_stories');
    }


     /**
     * Show the application success stories page.
     *
     * @return \Illuminate\Http\Response
     */

    public function scheduling_panel()
    {
        $id = $this->user_id;
        $business = $this->business_id;
        if(session('permission') == 0){
            return redirect('/');
        }
        $businessinfo = PanelTemplate::where('business', $business)->first();
        if(isset($businessinfo->gjs_html) && !empty($businessinfo->gjs_html)){
            $html = $businessinfo->gjs_html;
            $user_id = $businessinfo->user_id;
            $MarkDomain = $businessinfo->marked_domain;
        }else{
            $html = '';
            $user_id = '';
        }

       /* $sizes = $businessinfo->BuildingSizes;
        $types = $businessinfo->BuildingTypes;
        $addons = $businessinfo->Addons;
        $Location = $businessinfo->Location->pluck('name', 'id');*/
        
        return view('building.scheduling_panel', compact('html', 'user_id', 'MarkDomain'));
    }

    /**
    * Update template url
    *
    * @return \Illuminate\Http\Response
    */


    public function UpdateTemplateUrl()
    {
        $id = $this->user_id;
        $data = Input::get();
        $panelurl = $data['txtDomain'];

        if (strpos($panelurl, ".") !== false) {
            $rchar = array('https', 'http', 'www'); // content to be deleted from string

            $panelurl = str_replace($rchar, "", $panelurl);
            //$panelurl = preg_replace('/[^A-Za-z0-9\-]/', '', $panelurl);
        }

        $panel = PanelTemplate::updateOrCreate(
            ['user_id' => $id],
            [
                'unique_url' => $panelurl,
                'marked_domain' => 1
            ]
        );

        session(['hashvalue' => $panelurl]);

        $data = json_encode(['Element 1','Element 2','Element 3','Element 4','Element 5']);
        $file ='.htaccess';
        $destinationPath = storage_path('upload/');
        if (!is_dir($destinationPath)) { 
            mkdir($destinationPath,0755,true);
        }
        $content_string = "RewriteEngine On\n";

        // change www.website.com for your website
        $content_string .= "Redirect 301 / http://scheduleze20.com/template/".$panelurl."\n";
        File::put($destinationPath.$file, $content_string);
        $destinationPath = storage_path('upload/'.$file);
        //return response()->download($destinationPath);

        return redirect('/scheduling/schedulepanel')->with('message', 'Please download the file <a href="http://scheduleze20.com/schedulepanel/'.$file.'">.htaccess file</a>');
        //return redirect('/scheduling/schedulepanel')->with('message', 'success');
    }

    public function downloadfile($file='')
    {
        $file_path = storage_path('upload/'.$file);
        return response()->download($file_path);
    }

     /**
     * Show the application demo page.
     *
     * @return \Illuminate\Http\Response
     */


    public function demo()
    {
        return view('scheduleze.demo');
    }

     /**
     * Show the application faq page.
     *
     * @return \Illuminate\Http\Response
     */

    public function faq()
    {
        return view('scheduleze.faq');
    }

      /**
     * Show the application signup page.
     *
     * @return \Illuminate\Http\Response
     */

    public function signup()
    {
        return view('scheduleze.signup');
    }

         /**
     * Show the application contact page.
     *
     * @return \Illuminate\Http\Response
     */

    public function contact()
    {
        return view('scheduleze.contact');
    }
}
