<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\UserDetails;
use Auth;
use App\Inspector;
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
            return redirect('/add_inspector')->withErrors($validatedData)->withInput();
        }

        $Inspector = Inspector::updateOrCreate(
            ['business' => $businessid, 'removed' => '0'],
            [
                'business' => $businessid,
                'hidden' => $data['masking'],
                'name' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'email' => $data['email'],
                'email2' => $data['backupEmail'],
                'password' => bcrypt($data['password']),
                'padding_day' => $data['padding_day'],
                'look_ahead' => $data['day_forward'],
                'throttle' => $data['throttle'],
                'permission' => $data['permission']
            ]
        );
  
        return redirect('/scheduling_solutions')->with('success', 'Successfully Saved!');
    }
}