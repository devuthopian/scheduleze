<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function UserProfile()
    {
        $userid   =   Auth::id();
        $Userdata = User::where('id', $userid)->first();
        $UserBusinessdata = Business::where('user_id', $userid)->first();
        $data = [
            'Userdata'         => $Userdata,
            'UserBusinessdata' => $UserBusinessdata,
        ];
        return view('profiles.UserProfileEdit')->with($data);
    }
}