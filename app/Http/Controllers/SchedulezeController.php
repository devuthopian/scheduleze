<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\BusinessHours;
use App\PanelTemplate;

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

    /**
    * Show the application Blockouts hours.
    *
    * @return \Illuminate\Http\Response
    */

    public function blockouts_occurance()
    {
        $id = session('id');
        //$businesshours = BusinessHours::where([['user_id','=',$id],['removed','=',0]])->get();
        //return view('appointments.business_hours', compact('businesshours'));
        return view('appointments.reoccurrence');
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
