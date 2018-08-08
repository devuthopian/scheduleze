<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Socialite;
use App\User;
use Illuminate\Validation\ValidationException;
use App\Business;
use App\PanelTemplate;
use Auth;
use App\Http\Controllers\Auth\InspectorAuthController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/scheduling_solutions';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    use InspectorAuthController;
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
    * Get the failed login response instance.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Symfony\Component\HttpFoundation\Response
    *
    * @throws \Illuminate\Validation\ValidationException
    */
    /*protected function sendFailedLoginResponse(Request $request)
    {
        $data = $this->loginInspector($request);
        if($data == true){
            return redirect('/scheduling_solutions')->with('warning', 'You logged in as Inspector');
        }else{
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }*/

    /**
    * Override the username method used to validate login
    *
    * @return string
    */
    public function username()
    {
        return 'name';
    }

     public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        //$PanelTemplate = $user->Panel($user->id);
        $PanelTemplate = PanelTemplate::where('user_id',$user->id)->first();
        session(['id' => $user->id, 'username' => $user->name, 'hashvalue' => $PanelTemplate->unqiue_url]);
        $business = Business::where('user_id', $user->id)->first();

        if($business){
            session(['business_id' => $business->id]);
        }
        if(!empty($PanelTemplate->unqiue_url)){
            return redirect('/template/'.$PanelTemplate->unqiue_url);
        }

        return redirect()->intended($this->redirectPath());
        
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }


    /**
     * Redirect the user to the social media authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        //$user->token;

        $user = User::where([['email', '=', $userSocial->getEmail()],['verified', '=', 1]])->first();
 
        if($user){

            Auth::login($user);
            session(['id' => $user->id]);

            $business = Business::where('user_id', $user->id)->first();

            if($business){
                session(['business_id' => $business->id]);
            }

            return redirect()->action('HomeController@index');

        }else{
            $randpass = rand(1,10000);
            $user = new User;
            $user->name = $userSocial->getName();
            $user->email = $userSocial->getEmail();
            $user->password = bcrypt($randpass);
            $user->verified = 1;
            $user->save();
            session(['id' => $user->id]);
            $business = Business::where('user_id', $user->id)->first();

            if($business){
                session(['business_id' => $business->id]);
            }

            Auth::login($user);

            $hashvalue = session('hashvalue');
            if(!empty($hashvalue)){
                $return = '/template'.$hashvalue;
            }else{
                $return = $this->redirectPath();
            }
            return redirect($return)->with('status', 'You Temporary Password is '.$randpass.'. Please change it in profile section!');

        }
    }
}
