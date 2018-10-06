@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 cls_login">
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <div class="login_section">
                <div class="container">
                    <!-- <div class="login_left_cont">
                        <img src="images/login_img.png" alt="">
                    </div> -->
                    <div class="login_right_cont">
                        <div class="card-header">{{ __('Login') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group row">
                                   <!--  <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $value ? $value : '' }}" placeholder="Username" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- 
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="txtremember" id="txtremember">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-7 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="logged_in" id="logged_in">
                                            <label class="form-check-label" for="Loggin in">
                                                {{ __('Stay me Logged In') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-4">
                                        <input type="submit" value="{{ __('Login') }}">
                                      
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                               <div class="social_icon">
                                    <a href="{{ url('login/facebook') }}"><span><i class="fab fa-facebook-f"></i></span></a>
                                    <a href="{{ url('login/google') }}"><span><i class="fab fa-google"></i></span></a>
                                </div>
                            </form>
                            <br>
                            <p class="change_link">
                                Not a member yet ?
                                <a class="btn btn-link" href="{{ url('/') }}/#signup">
                                    Click here
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection