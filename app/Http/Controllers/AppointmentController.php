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

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('id');
        $businessinfo = Business::where('user_id', $id)->first();
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
        $id = session('id');
        $business_id = session('business_id');

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
                ['user_id' => $id,'day' => $i],
                [
                    'user_id' => $id,
                    'business' => $business_id, 
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
        $id = session('id');
        $business_id = session('business_id');

        $data = Input::get();

        foreach ($data['dt'] as $k => $drive) {
            foreach ($drive as $j => $time) {
                $sq['1'] = $k;
                $sq['2'] = $j;
                $sq['3'] = $time;
                $sq['4'] = $business_id;

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
                        'user_id' => $id,
                        'business' => $business_id,
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
        $id = session('id');
        $business_id = session('business_id');

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
                    $sql['business'] = $business_id;
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
                                'user_id' => $id,
                                'business' => $business_id, 
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
        $endtime = (( $starttime + $buffer ) - 2);

        $data = Input::get();
        $Booking = Booking::create([
            'price' => $request->input('total_price'),
            'user_id' => $request->input('inspector'),
            'location' => $request->input('location'),
            'building_type' => $request->input('building_type'),
            'building_size' => $request->input('building_size'),
            'building_age' => $request->input('building_ages'),
            'business' => $request->input('business'),
            'starttime' => $request->input('starttime'),
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

        return redirect('/scheduling_solutions')->with('message','Successfully saved!');
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
