<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Booking;
use App\BusinessHours;
use App\Daysoff;
use App\LocationTime;
use App\PanelTemplate;
use App\Location;
use App\UserDetails;
use Illuminate\Support\Facades\Input;
use PDF;
use DB;

class SchedulezeController extends Controller
{
	 /**
     * Show the application homepage.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('scheduleze.welcome');
    }

     /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */

    public function scheduling_solutions()
    {
        return view('scheduleze.scheduling_solutions');
    }

    public function ZigZag()
    {
        $id = session('id');
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
        $id = session('id');

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

        return redirect('/scheduleze/zigzag')->with('message', 'ZigZag changes saved');
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
        $id = session('id');
        $businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();
        return view('appointments.business_hours', compact('businesshours'));
    }

    public function BookingFilter(Request $request, $form)
    {
        $data = Input::get();

        if(empty($data['users_details'])){
            $id = session('id');
        }else{
            $id = $data['users_details'];
        }

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

        return view('appointments.bookings', compact('id','first','last','order', 'inc', 'form'));
    }

    public function storeBlockout(Request $request, $form)
    {
        $data = Input::get();        
        check_permission($data['users_details']);

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
            'type' => $type
        ]);

        $blockId = $Booking->id;

        return redirect('/scheduleze/booking/blockouts')->with('message', 'blockout changes saved');
    }

    /**
    * Show the application business appointments.
    *
    * @return \Illuminate\Http\Response
    */
    public function Bookings($form, $userid = null)
    {
        if(empty($userid)){
            $id = session('id');
        }else{
            $id = $userid;
        }

        $first = time();
        $last = $first + 1209500;

        /*$businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();*/
        return view('appointments.bookings', compact('id', 'first', 'last','form'));
    }

    public function UpdateBooking(Request $request, $id)
    {
        $data = Input::get();

        dd($data);

        $getstend = DB::table('bookings')->select('starttime', 'endtime')->where('id', $id)->first();

        if (isset($data['quote_override'])){
            if($data['quote_override'] != "1"){
                $this_total_price = get_total_price($data['building_type'],$data['building_size'],$data['building_age'], $data['location'], $data['addon']);
            }
        } else {
            $this_total_price = str_replace("$", "", $data['price']);
        }

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

        $building_type = $data['building_type'];
        if ($data['building_size'] > 0){
            $building_size = $data['building_size'];
        } else {
            $building_size = 0;
        }
        if ($data['building_age'] > 0){
            $building_age = $data['building_age'];
        } else {
            $building_age = 0;
        }
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

        if (is_array($data['addon'])){

            $delete = DB::table('addons_bookings')->where('booings', $data['target'])->delete();

            foreach ($data['addon'] as $addn){
                DB::table('addons_bookings')->insert(
                    ['addon' => $addn, 'booking' => $data['target']]
                );
            }
        }

        if($flash == 1){
            return redirect('/scheduleze/booking/edit/'.$id)->withErrors('Start time occurs after the specified endtime.  No change made to start or end times, other edits executed successfully');
        }

        return redirect('/scheduleze/booking/appointment')->with('message', 'success');
    }

    public function EditBooking(Request $request, $id)
    {
        $userid = session('id');
        $booking = Booking::where('id', $id)->first();

        $location_popup = get_location_popup($booking->location);

        $business = session('business_id'); //get business id from session
        $type_pop = get_pricing_popup($business, "building_types", "building_type", "smallselect", $booking->building_type);
        $size_pop = get_pricing_popup($business, "building_sizes", "building_size",  "smallselect", $booking->building_size);
        $age_pop = get_pricing_popup($business, "building_ages", "building_age", "smallselect", $booking->building_age);

        $inspector_popup = get_inspector_popup('name', $userid);

        $start_popup = get_time_popup ($booking->starttime, $designate = "", 1, 1, 1, 1, 1, 1, 'starttime');
        $end_popup = get_time_popup (($booking->endtime + 2), $designate = "1", 1, 1, 1, 1, 1, 1, 'endtime');


        //$ss = "select addon from addons_bookings where booking = '$row[id]'";
        $addons_edit = DB::table('addons_bookings')->select('addon')->where('booking', $booking->id)->get()->toArray();
        //$addons_edit = $l->pull_flat_multi($ss);
        if(!isset($addons_edit)){
            $addons_edit = '';
        }

        $add_on_checkboxes = get_addon_checkboxes("addons", "id", "name", "addon", "", "rank", "ASC", "40", $addons_edit, 3);

        $groupdata = array('userid' => $userid, 'booking' => $booking, 'location_popup' => $location_popup, 'type_pop' => $type_pop, 'size_pop' => $size_pop, 'age_pop' => $age_pop, 'inspector_popup' => $inspector_popup, 'start_popup' => $start_popup, 'end_popup' => $end_popup, 'add_on_checkboxes' => $add_on_checkboxes, 'id' => $id);

        
        return view('appointments.editbooking', compact('groupdata'));
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

        return back()->with('message', 'Process Failed! Please try again');

    }
    public function Blockout($form, $blockId = null)
    {
        $id = session('id');
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
        $business_id = session('business_id');
        $LocationTime = LocationTime::where([['business','=',$business_id],['removed','=',0]])->get()->toArray();
        $Location = Location::where([['business','=',$business_id],['removed','=',0]])->get()->toArray();
        $locs2 = $Location;
        return view('appointments.drivetimes',['LocationTime' => $LocationTime, 'locs2' => $locs2, 'Location' => $Location]);
    }

    /**
    * Show the application Blockouts hours.
    *
    * @return \Illuminate\Http\Response
    */

    public function blockouts_occurance()
    {
        $id = session('id');
        $Daysoff = Daysoff::where([['user_id','=',$id],['removed','=',0]])->get();
        return view('appointments.reoccurrence', compact('Daysoff'));
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
        $id = session('id');
        $businessinfo = PanelTemplate::where('user_id',$id)->first();
        $html = $businessinfo->gjs_html;

       /* $sizes = $businessinfo->BuildingSizes;
        $types = $businessinfo->BuildingTypes;
        $addons = $businessinfo->Addons;
        $Location = $businessinfo->Location->pluck('name', 'id');*/
        
        return view('building.scheduling_panel', compact('html'));
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
