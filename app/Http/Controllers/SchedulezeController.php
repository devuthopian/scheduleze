<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Show the application success stories page.
     *
     * @return \Illuminate\Http\Response
     */

        public function success_stories()
    {
        return view('scheduleze.success_stories');
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
        return view('welcome');
    }
}
