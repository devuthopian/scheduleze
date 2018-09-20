@extends('layouts.front')

@section('content')
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-warning">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif

<div class="set_recc_block">
	<div class="container">
		<div class="frameadmin">
			<h2>Map My Day</h2>
			<h5>Your timeline in Google Maps helps you find the places you've been and the routes.</h5>
		</div>
		<div id="map"></div>
	</div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/mapmyday.js') }}"></script>
<?php 
	$GOOGLE_MAP_KEY = env('GOOGLE_MAP_KEY'); 
?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$GOOGLE_MAP_KEY}}&callback=initMap" type="text/javascript"></script>

@endsection