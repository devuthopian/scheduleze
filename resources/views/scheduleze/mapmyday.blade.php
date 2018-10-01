@extends('layouts.front')

@section('content')
@if(!empty($errors->first()))
    <div class="row col-lg-12">
        <div class="alert alert-warning">
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif

<?php 
	$GOOGLE_MAP_KEY = env('GOOGLE_MAP_KEY');

	$prepAddr = str_replace(' ','+',$location);
	$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?key='.$GOOGLE_MAP_KEY.'&address='.$prepAddr.'&sensor=false');
	$output = json_decode($geocode);
	if($output->error_message){
		$error = $output->error_message;
		$latitude = '';
		$longitude = '';
	}else{
		$error = '';
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
	}
?>

<div class="set_recc_block">
	<div class="container">
		@if(!empty($error))
		    <div class="row col-lg-12">
		        <div class="alert alert-danger">
		            <span>{{ $error }}</span>
		        </div>
		    </div>
		@endif
		<div class="frameadmin">
			<h2>Map My Day</h2>
			<h5>Your timeline in Google Maps helps you find the places you've been and the routes.</h5>
		</div>
		<div id="map"></div>
	</div>
</div>
<!-- <script type="text/javascript" src="{{ URL::asset('js/mapmyday.js') }}"></script> -->



<script type="text/javascript">
	var map;
	var infowindow;

	function initMap() {
	    var pyrmont = {
	        lat: parseFloat('{{$latitude}}'),
	        lng: parseFloat('{{$longitude}}'
        };

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: pyrmont,
            radius: 500,
            type: ['store']
        }, callback);
    }

    function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
        }
    }

    function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(place.name);
            infowindow.open(map, this);
        });
    }
</script>



<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{$GOOGLE_MAP_KEY}}&callback=initMap" type="text/javascript"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$GOOGLE_MAP_KEY}}&libraries=places&callback=initMap"></script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&key={{$GOOGLE_MAP_KEY}}&callback=initMap" type="text/javascript"></script> -->

@endsection