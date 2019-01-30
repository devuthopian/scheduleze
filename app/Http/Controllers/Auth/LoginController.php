<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

use Socialite;
use App\User;
use Illuminate\Validation\ValidationException;
use App\Business;
use App\PanelTemplate;
use Auth;
use App\Http\Controllers\Auth\InspectorAuthController;
use Cookie;

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
    protected $redirectTo = '/scheduleze/booking/appointment';

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

    public function showLoginForm()
    {
        $value = Cookie::get('name');
        return view('auth.login', compact('value'));
    }

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
            return back()->with('warning', trans('auth.MessageforConfirmAccount'));
        }

        if($request->input('txtremember') == 'on') {
            //Cookie::queue(Cookie::forget('name'));
            $username = $user->name;
            $expire = time() + 960*60*24*180;
            //print_r($username);
            //$response->withCookie(Cookie::queue('name', $username, $expire));
            Cookie::queue('name', $username, $expire);
        }
        
        //$PanelTemplate = $user->Panel($user->id);
        
        $permission = get_field("users_details", "permission", $user->id); //get permission details
        $administrator = get_field("users_details", "administrator", $user->id); //get administrator details
        $indus_id = get_field("users_details", "indus_id", $user->id);
        $custom_indus_name = get_field("users_details", "custom_indus_name", $user->id);
        $engage = get_field("users_details", "engage", $user->id);
        

        if($administrator == 1) {
            $business = Business::where('user_id', $user->id)->first();

            if($business){
                session(['business_id' => $business->id]);
                get_business_information($business->id);
            }else{
                return redirect('business_info')->with('warning', trans('auth.MessageforBusinessWarning'));
            }
        }else{
            $user_details = get_field("users_details", "business", $user->id);
            session(['business_id' => $user_details]);
            get_business_information($user_details);
        }

        $businessID = session('business_id');

        $PanelTemplate = PanelTemplate::where('business', $businessID)->first();
        if(empty($PanelTemplate)){
            $panelurl = '';
        }else{
            $panelurl = $PanelTemplate->unique_url;
        }

        session(['id' => $user->id, 'username' => $user->name, 'hashvalue' => $panelurl, 'permission' => $permission, 'indus_id' => $indus_id, 'administrator' => $administrator, 'engage' => $engage]);

        $IndustryName = get_field('business_types', 'business', $indus_id); //tablename, columnname, Id
        session(['IndustryName' => $IndustryName]);

        if(!empty($custom_indus_name) || $custom_indus_name != null) {
            session(['CustomIndustryName' => $custom_indus_name]);
        }

        //if(!empty($PanelTemplate->unique_url)){
            //return redirect('/template/'.$PanelTemplate->unique_url);
        //}

        if($request->input('logged_in') == 'on'){
            $path = base_path('.env');

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'SESSION_LIFETIME=60', 'SESSION_LIFETIME=1440', file_get_contents($path)
                ));
            }
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
            $permission = get_field("users_details", "permission", $user->id);
            session(['id' => $user->id, 'permission' => $permission]);

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
            $permission = get_field("users_details", "permission", $user->id);
            session(['id' => $user->id, 'permission' => $permission]);
            $business = Business::where('user_id', $user->id)->first();

            if($business){
                session(['business_id' => $business->id]);
            }

            Auth::login($user);

            $hashvalue = session('hashvalue');
            //if(!empty($hashvalue)){
                //$return = '/template'.$hashvalue;
            //}else{
            $return = $this->redirectPath();
            //}
            return redirect($return)->with('status', 'You Temporary Password is '.$randpass.'. Please change it in profile section!');

        }
    }
}
