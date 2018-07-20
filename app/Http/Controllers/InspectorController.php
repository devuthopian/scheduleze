<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\UserDetails;
use Auth;
use Illuminate\Support\Facades\Validator;


class InspectorController extends Controller
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

    public function Inspector_Profile_Validator(array $data)
    {
        return Validator::make($data, [
            'firstname'         => 'required',
            'lastname'          => 'required',
            'password'          => 'confirmed',
            'email'          => 'required|email',
            'username'          => 'required',
        ]);
    }

   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function add_inspector()
    {
        return view('inspectors.Add_Inspector');
    }
       public function save_inspector(Request $request)
    {
        $userid            =   Auth::id();
        $Inspector_Profile_Validator = $this->Inspector_Profile_Validator($request->all());
        if ($Inspector_Profile_Validator->fails()) {
            return back()->withErrors($Inspector_Profile_Validator)->withInput();
        }
            $user = User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt( $request->input('password')),
            ]);

            $userInfo = UserDetails::create([
            'user_id' => $user->id,
            'name' => $request->input('firstname'),
            'email2' =>  $request->input('backupEmail'),
            'padding_day' =>  $request->input('padding_day'),
            'look_ahead' => $request->input('day_forward'),
            'throttle' => $request->input('throttle'),
            'permission' => $request->input('permission'),
            ]);
  
        return redirect('/add_inspector')->with('success', trans('profile.updateSuccess'));
    }
}