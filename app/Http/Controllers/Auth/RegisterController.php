<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Business;
use App\UserDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
//use Mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/ConfirmStatus')->with('confirmstatus', trans('auth.MessageforCheckMail'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        auth()->logout();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            //'email' => 'required|string|email|max:255|unique:users',
            //'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            //'password' => bcrypt($data['password']),
        ]);
 
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $userdetails = UserDetails::create([
            'user_id' => $user->id,
            'indus_id' => $data['txtIndustries'],
            'engage' => $data['txtEngage'],
            'permission' => 1
        ]);

        $users = User::firstOrNew(array('id' => $user->id));
        $users->users_details_id = $userdetails->id;
        $users->save();

        Mail::to($user->email)->send(new VerifyMail($user));

        if( count(Mail::failures()) > 0 ) {

           foreach(Mail::failures as $email_address) {
               echo "$email_address <br />";
            }

        }else{
            return $user;
        }
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status =  trans('auth.MessageStatusOne');
            }else{
                $status = trans('auth.MessageforalVerification');
            }
        }else{
            return redirect('/login')->with('warning', trans('auth.MessageforIdentification'));
        }

        $check_reg = Business::where('user_id', $verifyUser->user_id)->first();
        $username = User::where('id', $verifyUser->user_id)->select('name')->first();

        if(isset($check_reg )){
            if(!$check_reg->registration_completed){
            return redirect('/account_info/?token='.$token)->with('status', $status)->with('username', $username);
            } else {
            return redirect('/login')->with('warning', trans('auth.MessageforRegisterWarning'));
            }
        } else{
            return redirect('/account_info/?token='.$token)->with('status', $status)->with('username', $username);
        }
    }

    public function account_info()
    {
        $verifyUser = VerifyUser::where('token',$_GET['token'])->first();

        $check_reg = Business::where('user_id', $verifyUser->user_id)->first();
        $username = User::where('id', $verifyUser->user_id)->select('name')->first();
        $engageStyle = DB::table('users_details')->where('user_id', $verifyUser->user_id)->select('engage')->first();

        if(isset($check_reg )){
            if(!$check_reg->registration_completed){
                return view('auth.account_info', compact('username', 'engageStyle'));
            } else {
                return redirect('/login')->with('warning', trans('auth.MessageforRegisterWarning'));
            }
        } else{
            return view('auth.account_info', compact('username', 'engageStyle'));
        }
    }

    public function account_info_save(Request $request)
    {
        /*$validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'contact_firstname' => 'required',
            'contact_lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'public_phone' => 'required',
            'website' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }*/

        $user_token = $request->input('user_token'); // option 1
        $verifyUser = VerifyUser::where('token', $user_token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if($user->verified) {
                $business = Business::create([
                    'name' => $request->input('business_name'),
                    'user_id' => $verifyUser->user_id,
                    'contact_firstname' => $request->input('contact_firstname'),
                    'contact_lastname' => $request->input('contact_lastname'),
                    'address' => $request->input('business_address'),
                    'city' => $request->input('business_city'),
                    'state' => $request->input('state'),
                    'zip' => $request->input('business_zip'),
                    'phone' => $request->input('business_phone'),
                    'public_phone' => $request->input('additional_phone'),
                    //'timezone' => $request->input('timezone'),
                    'website' => $request->input('business_website'),
                    'email2' => $request->input('requested_email'),
                    'registration_completed' => '1',
                    'first_screen_note' => $request->input('use_scheduleze'),
                ]);
                /*UserDetails::create([
                    'user_id' => $verifyUser->user_id,
                ]);*/
                $verifyUser->user->name = $request->input('Username');
                //$verifyUser->userdetails->name = $request->input('Username');
                $verifyUser->user->password = bcrypt($request->input('pass'));
                $verifyUser->user->save();

                $userdetails = UserDetails::firstOrNew(array('user_id' => $verifyUser->user_id));
                $userdetails->business = $business->id;
                $userdetails->name = $request->input('contact_firstname');
                $userdetails->lastname = $request->input('contact_lastname');
                $userdetails->administrator = 1;
                $userdetails->save();

                session(['business_id' => $business->id]);
                $status =  trans('auth.MessageforSignComplete');
            }else{
                $status =  trans('auth.MessageforalVerification');
            }
        }else{
            return redirect('/login')->with('warning', trans('auth.MessageforIdentification'));
        }
        return redirect('/login')->with('status', $status);
    }
}
