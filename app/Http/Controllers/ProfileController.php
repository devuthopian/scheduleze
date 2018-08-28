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

   public function business_profile_validator(array $data)
    {
        return Validator::make($data, [
            'business_name'     => 'required',
            'business_fname'    => 'required',
            'business_lname'    => 'required',
        ]);
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function UserProfile($id = null)
    {
        if(empty($id)){
            $userid           =   Auth::id();
        }else{
            $userid           =   $id;
        }
        
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
        $UserDetails->user->password     = bcrypt($request->input('password'));
        $UserDetails->save();
        $UserDetails->user->save();
      
        return redirect('/profile')->with('message', trans('profile.updateSuccess'));
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
        $business_profile_validator = $this->business_profile_validator($request->all());
        if ($business_profile_validator->fails()) {
            return back()->withErrors($business_profile_validator)->withInput();
        }
        $UserBusinessDetails = Business::firstOrNew(array('user_id' => $userid));
        $UserBusinessDetails->user_id           = $userid;
        $UserBusinessDetails->name              = $request->input('business_name');
        $UserBusinessDetails->contact_firstname = $request->input('business_fname');
        $UserBusinessDetails->contact_lastname  = $request->input('business_lname');
        $UserBusinessDetails->address           = $request->input('business_address');
        $UserBusinessDetails->city              = $request->input('business_city');
        $UserBusinessDetails->state             = $request->input('business_state');
        $UserBusinessDetails->zip               = $request->input('business_zip');
        $UserBusinessDetails->phone             = $request->input('business_phone');
        $UserBusinessDetails->phone2            = $request->input('business_additional_phone');
       // $UserBusinessDetails->timezone                = $request->input('business_timezone');
        $UserBusinessDetails->email             = $request->input('business_email');
        $UserBusinessDetails->website           = $request->input('business_website');
        $UserBusinessDetails->paypal            = $request->input('offer_paypal_account');
        $UserBusinessDetails->paypal_email          = $request->input('business_paypal_email');
        $UserBusinessDetails->public_email      = $request->input('business_public_email');
        $UserBusinessDetails->email2            = $request->input('business_secondary_email');
        $UserBusinessDetails->offer_cancellation = $request->input('offer_cancellation');
        $UserBusinessDetails->no_cancel_within      = $request->input('no_cancel_within');
        $UserBusinessDetails->require_inspection_zip  = $request->input('require_inspection_zip');
        $UserBusinessDetails->print_ticket_email      = $request->input('print_ticket_email');
        $UserBusinessDetails->require_agent           = $request->input('require_agent');
        $UserBusinessDetails->require_listing_agent   = $request->input('require_listing_agent');
        $UserBusinessDetails->agent_company_label     = $request->input('agent_company_label');
        $UserBusinessDetails->enotice_days_before     = $request->input('enotice_days_before');
        $UserBusinessDetails->include_event_ics       = $request->input('include_event_ics');

        $UserBusinessDetails->save();

        $UserDetails = UserDetails::firstOrNew(array('user_id' => $userid));
        $UserDetails->business = $UserBusinessDetails->id;
        $UserDetails->save();
        
        return redirect('/business_info')->with('message', trans('profile.updateSuccess'));
    }

}