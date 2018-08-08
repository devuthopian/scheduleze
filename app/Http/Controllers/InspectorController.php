<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\UserDetails;
use Auth;
use App\Users;
use Mail;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class InspectorController extends Controller
{
    
    /**
     * @var Upload path
     */
    protected $businessid = '';
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->businessid = session('business_id');
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
    public function store(Request $request)
    {        
        $businessid = $this->businessid;
        $data = Input::get();

        $validatedData = Validator::make($request->all(), [
            'username' => 'required|string|unique:inspectors,username',
            'email' => 'required|string|unique:inspectors,email',
            'password' => 'required|confirmed',
        ]);

        if ($validatedData->fails()) {
            return redirect('/scheduleze/add_inspector')->withErrors($validatedData)->withInput();
        }

        $user = User::create([
            //'name' => $data['name'],
            'email' => $data['email'],
            'name' => $data['username'],
            'password' => bcrypt($data['password'])            
        ]);
 
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        UserDetails::create([
            'user_id' => $user->id,
            'indus_id' => 0,
            'business' => $businessid,
            'hidden' => $data['masking'],
            'lastname' => $data['lastname'],
            'name' => $data['firstname'],
            'email2' => $data['backupEmail'],
            'padding_day' => $data['padding_day'],
            'look_ahead' => $data['day_forward'],
            'throttle' => $data['throttle'],
            'permission' => $data['permission']
        ]);
        
        Mail::to($user->email)->send(new VerifyMail($user));

        return redirect('/scheduling_solutions')->with('status', 'We sent '.$data["username"].' an activation code.');
    }
}