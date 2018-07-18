@extends('layouts.front')

@section('content')
<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
@csrf
    <div class="signup_section">
        <div class="signup_cont">
            <h3>User Profile edit</h3>
        </div>
    </div>
</form>
@endsection
