@extends('layouts.front')

@section('content')
<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
@csrf
    <div class="signup_section" style="min-height: 400px !important;">
        
    </div>
</form>
@endsection
