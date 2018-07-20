<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\UserDetails;
use Auth;
use Illuminate\Support\Facades\Validator;


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

    public function profile_validator(array $data)
    {
        return Validator::make($data, [
            'firstname'         => 'required',
            'lastname'          => 'required',
            'password'          => 'confirmed',
        ]);
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function UserProfile()
    {
        $userid           =   Auth::id();
        $UserData         =   UserDetails::where('user_id', $userid)->first();
        $data = [
            'UserData' => $UserData,
        ];
        return view('profiles.UserProfileEdit')->with($data);
    }
       public function updateUserAccount(Request $request)
    {
        $userid            =   Auth::id();
        $profile_validator = $this->profile_validator($request->all());
        if ($profile_validator->fails()) {
            return back()->withErrors($profile_validator)->withInput();
        }
        $UserDetails = UserDetails::firstOrNew(array('user_id' => $userid));
        $UserDetails->user_id        = $userid;
        $UserDetails->name           = $request->input('firstname');
        $UserDetails->lastname       = $request->input('lastname');
        $UserDetails->email2         = $request->input('backupEmail');
        $UserDetails->padding_day    = $request->input('padding_day');
        $UserDetails->look_ahead     = $request->input('day_forward');
        $UserDetails->throttle       = $request->input('throttle');
        $UserDetails->permission     = $request->input('permission');
        $UserDetails->user->name     = $request->input('username');
        $UserDetails->save();
        $UserDetails->user->save();
      
        return redirect('/profile')->with('success', trans('profile.updateSuccess'));
    }

      public function UserBusinessProfile()
    {
        $userid           =   Auth::id();
        $UserBusinessData =   Business::where('user_id', $userid)->first();
        $data = [
            'UserBusinessData' => $UserBusinessData,
        ];
        return view('profiles.UserBusinessProfileEdit')->with($data);
    }
       public function updateUserBusinessAccount(Request $request)
    {
        $userid            =   Auth::id();
        $profile_validator = $this->profile_validator($request->all());
        if ($profile_validator->fails()) {
            return back()->withErrors($profile_validator)->withInput();
        }
        $UserDetails = UserDetails::firstOrNew(array('user_id' => $userid));
        $UserDetails->user_id        = $userid;
        $UserDetails->name           = $request->input('firstname');
        $UserDetails->lastname       = $request->input('lastname');
        $UserDetails->email2         = $request->input('backupEmail');
        $UserDetails->padding_day    = $request->input('padding_day');
        $UserDetails->look_ahead     = $request->input('day_forward');
        $UserDetails->throttle       = $request->input('throttle');
        $UserDetails->permission     = $request->input('permission');
        $UserDetails->user->name     = $request->input('username');
        $UserDetails->save();
        $UserDetails->user->save();
      
        return redirect('/profile')->with('success', trans('profile.updateSuccess'));
    }

}