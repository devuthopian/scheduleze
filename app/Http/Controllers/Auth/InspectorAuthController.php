<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Socialite;
use App\User;
use App\InspectorAuth;
use App\Business;


trait InspectorAuthController
{
	protected $guard = 'inspector';
	public function __construct()
    {
    	$this->middleware('guest')->except('logout');
    }

    public function loginInspector(Request $request)
    {
		// Validate the form data
		$this->validate($request, [
			'name'   => 'required',
			'password' => 'required'
		]);
		// Attempt to log the user in
		if (Auth::guard('inspector')->attempt(['username' => $request->name, 'password' => $request->password], $request->remember)) {
			$Inspector = InspectorAuth::where('username', $request->name)->first();
			//Auth::guard('inspector')->login($Inspector);
			session(['id' => $Inspector->id, 'username' => $Inspector->username, 'business_id' => $Inspector->business]);
			// if successful, then redirect to their intended location
			return true;
			//return redirect()->action('HomeController@index');
		}
		return false;
		// if unsuccessful, then redirect back to the login with the form data
		//return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
