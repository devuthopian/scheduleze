<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
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
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            //'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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
            //'name' => $data['name'],
            'email' => $data['email'],
            //'password' => bcrypt($data['password']),
        ]);
 
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
 
        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now Signup Now.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
         $check_reg = Business::where('user_id', $verifyUser->user_id)->first();
          if(isset($check_reg )){
         if(!$check_reg->registration_completed){
          return redirect('/account_info/?token='.$token)->with('status', $status);
         } else {
          return redirect('/login')->with('warning', "your Registration allready Completed.");
         }
         } else{
          return redirect('/account_info/?token='.$token)->with('status', $status);
         }

    }

      public function account_info()
    {
          $verifyUser = VerifyUser::where('token',$_GET['token'])->first();

          $check_reg = Business::where('user_id', $verifyUser->user_id)->first();
          if(isset($check_reg )){
         if(!$check_reg->registration_completed){
          return view('auth.account_info');
         } else {
          return redirect('/login')->with('warning', "your Registration allready Completed.");
         }
         } else{
                 return view('auth.account_info');
         }


    }
        public function account_info_save(Request $request)
    {
        $user_token = $request->input('user_token'); // option 1
        $verifyUser = VerifyUser::where('token', $user_token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if($user->verified) {
               Business::create([
                    'name' => $request->input('business_name'),
                    'user_id' => $verifyUser->user_id,
                    'contact_firstname' => $request->input('contact_firstname'),
                    'contact_lastname' => $request->input('contact_lastname'),
                    'address' => $request->input('business_address'),
                    'city' => $request->input('business_city'),
                    'state' => $request->input('business_state'),
                    'zip' => $request->input('business_zip'),
                    'phone' => $request->input('business_phone'),
                    'public_phone' => $request->input('additional_phone'),
                    //'timezone' => $request->input('timezone'),
                    'website' => $request->input('business_website'),
                    'email2' => $request->input('requested_email'),
                    'registration_completed' => '1',
                ]);
                $verifyUser->user->name = $request->input('Username');
                $verifyUser->user->password = bcrypt($request->input('pass'));
                $verifyUser->user->save();
                $status = "Your Signup process Completed You can login now.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('status', $status);
    }
}
