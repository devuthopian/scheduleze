@extends('layouts.front')

@section('content')
<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
@csrf
    <div class="signup_section">
        <div class="signup_cont">
            <h3>Business Email Address</h3>
            <span class="input_field">
                <span class="input_icon"><img src="images/input_icon.png" alt=""></span> 
                <input id="email" type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
            </span>
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
