<?php
namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backend/services/industries';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('backend.guest')->except('logout');
    }

    public function showLoginForm()
    {
        if(Auth::guard('backend')->user()) {
            //if(session('backend_admin') == 1) {
                return redirect()->intended($this->redirectPath());
            //} else {
                //return redirect('/scheduleze/booking/appointment')->with('warning', 'you can\'t access backend');
            //}
        }
        return view('backend.auth.login');
    }

    public function login(Request $request) {

        $username = $request->get ( 'name' );
        $password = $request->get ( 'password' );

        $expire = time() + 960*60*24*180;

        if (Auth::guard('backend')->attempt ( array (
            'name' => $request->get ( 'name' ),
            'password' => $request->get ( 'password' ),
            'backend_admin' => 1
        ) ) ){
            //Auth::guard('backend')->user();

            $request->session()->put('authenticated', $expire);
            session(['backend_admin' => 1]);

            return redirect()->intended($this->redirectPath());
        }

        Session::flash ( 'warning', "Invalid Credentials , Please try again." );
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $this->guard('backend')->logout();
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect('/backend');
    }

    protected function guard()
    {
        return Auth::guard('backend');
    }
}