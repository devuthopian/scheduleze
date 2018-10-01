<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {

	public function setCookie(Request $request){
		$response = new Response('Hello World');
		$username = session('username');
        $response->withCookie(cookie()->forever('name', $username));
        return redirect('/scheduleze/booking/appointment');
	}

	public function getCookie(Request $request){
		$value = $request->cookie('name');
		return view('auth.login', compact('value'));
	}
}
