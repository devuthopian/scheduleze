<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\BusinessHours;
use App\Daysoff;
use App\LocationTime;
use App\PanelTemplate;
use App\Location;
use Illuminate\Support\Facades\Input;

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

    public function BookingFilter(Request $request)
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

        return view('appointments.bookings', compact('id','first','last','order', 'inc'));
    }

    /**
    * Show the application business appointments.
    *
    * @return \Illuminate\Http\Response
    */
    public function Bookings()
    {
        $id = session('id');
        $first = time();
        $last = $first + 1209500;
        /*$businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();*/
        return view('appointments.bookings', compact('id', 'first', 'last'));
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
