@extends('layouts.front')

@section('content')
<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
@csrf
    <div class="signup_section">
        <div class="signup_cont">
            <h3>Business Email Address</h3>
            <span class="input_field">
                <span class="input_icon"><img src="images/input_icon.png" alt=""></span>
                @if(!empty($email))
 
                   <input id="email" type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$email}}" required autofocus>

                @else

                   <input id="email" type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Your Email" required autofocus>

                @endif
            </span>
            <div class="col-md-12 social_login">
                <div class="col-md-6">
                    <a href="{{ url('login/facebook') }}" class="button button-facebook"><span><img src="{{URL::asset('/images/facebook-icon.png')}}">Sign up</span></a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="button button-google"><span><img src="{{URL::asset('/images/google-icon.png')}}">Sign up</span></a>
                </div>
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="clearfix"></div>
            <input type="Submit" value="SignUp">
            <h4>Questions? <a href="#">info@scheduleze.com</a></h4>       
        </div>
    </div>
</form>
@endsection
