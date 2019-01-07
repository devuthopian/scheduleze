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
	if(empty($GOOGLE_MAP_KEY)){
		$GOOGLE_MAP_KEY='AIzaSyAN_GbtrVtZfOedD5lhuggGCTMdDp0MHPw';
	}
	if(!empty($inspection_address)){
		if(is_array($inspection_address)){
			for ($i=0; $i < count($inspection_address); $i++) {
				if(!empty($inspection_address[$i])){

					$prepAddr = str_replace(' ','+',$inspection_address[$i]);
					$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?key='.$GOOGLE_MAP_KEY.'&address='.$prepAddr.'&sensor=false');
					$output = json_decode($geocode);

					if($output->status == 'REQUEST_DENIED')
					{
						$error = $output->error_message;
						$latitude = '';
						$longitude = '';
					}

					$error = '';
					$latitude[$i] = $output->results[0]->geometry->location->lat;
					$longitude[$i] = $output->results[0]->geometry->location->lng;
					$place_id[$i] = $output->results[0]->place_id;
					$formatted_address[$i] = $output->results[0]->formatted_address;

				}else{
					$latitude[$i] = '';
					$longitude[$i] = '';
					$place_id[$i] = '';
				}
			}
		}else{

			$prepAddr = str_replace(' ','+',$inspection_address);
			$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?key='.$GOOGLE_MAP_KEY.'&address='.$prepAddr.'&sensor=false');
			$output = json_decode($geocode);

			if($output->status == 'REQUEST_DENIED')
			{
				$error = $output->error_message;
				$latitude = '';
				$longitude = '';
			}
			$error = '';
			$latitude = $output->results[0]->geometry->location->lat;
			$longitude = $output->results[0]->geometry->location->lng;
			$place_id = $output->results[0]->place_id;

		}

	}else{
		$latitude = '';
		$longitude = '';
		$place_id = '';
	}
		
	$current_address = session('business_information.address').', '.session('business_information.city').', '.session('business_information.state').', '.session('business_information.zip');
	
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
		<div class="bookingmain">
			<div class="bookingcontainer">
				<form action="{{ url('/scheduleze/mapmyday') }}" method="post">
					@csrf
					{!! edit_filter($first, $id, $i_name='', $last, $administration) !!}
					<input type="hidden" name="track" value="1">
					<input type="hidden" name="trigger" value="2">
				</form>
			</div>
		</div>
		<div class="frameadmin">
			<h2>Map My Day</h2>
			<h5>Your timeline in Google Maps helps you find the places and the routes between them.</h5>
		</div>
		<div id="directions-panel"></div>

			@if(is_array($latitude))
				@for($i=0;$i<count($latitude);$i++)
					@php $lat[] = $latitude[$i].','.$longitude[$i].'/'; @endphp
				@endfor
				@php $lat = implode('', $lat); @endphp
			@else
				@php $lat = $latitude.','.$longitude; @endphp
			@endif


		<a href="https://www.google.com/maps/dir//{{$lat}}" target="_blank">Click here to open Google MAP</a>

		<h4>Map for {!! get_field('users', 'name', $id) !!}</h4>
		<div id="map"></div>
	</div>
</div>
<!-- <script type="text/javascript" src="{{ URL::asset('js/mapmyday.js') }}"></script> -->

<script type="text/javascript">
	var map, infowindow;

	function initMap() {
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
@php
			if(!empty($inspection_address)){
				if(is_array($inspection_address)){
@endphp
				    var pyrmont = {
				        lat: parseFloat('{{ $latitude[0] }}'),
				        lng: parseFloat('{{ $longitude[0] }}')
			        };       

			        map = new google.maps.Map(document.getElementById('map'), {
			        	
			            center: pyrmont,
			            zoom: 13,
			            mapTypeId: google.maps.MapTypeId.ROADMAP
			        });

			        directionsDisplay.setMap(map);
					calculateAndDisplayRoute(directionsService, directionsDisplay);
			        
			        infowindow = new google.maps.InfoWindow();
			       	var service = new google.maps.places.PlacesService(map);
			       	// var marker = new google.maps.Marker({position: pyrmont, map: map});
			       	var marker;

			       	// Try HTML5 geolocation.
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(function(position) {
							var pos = {
								lat: position.coords.latitude,
								lng: position.coords.longitude
							};

							infoWindow.setPosition(pos);
							infoWindow.setContent('Location found.');
							infoWindow.open(map);
							map.setCenter(pos);
						}, function() {
							handleLocationError(true, infoWindow, map.getCenter());
						});
					} else {
						// Browser doesn't support Geolocation
						handleLocationError(false, infoWindow, map.getCenter());
					}
			        @php

			        for ($j = 0; $j < count($inspection_address); $j++) {
			        	if(!empty($inspection_address[$j]) || $inspection_address[$j] != null) {
			        		@endphp

					        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
								var waypts = [];
								

								directionsService.route({
									origin: '{{ $current_address }}',
									destination: '{{$formatted_address[count($inspection_address)-1]}}',
									waypoints: waypts,
									optimizeWaypoints: true,
									travelMode: 'DRIVING'
								}, function(response, status) {
									if (status === 'OK') {
										directionsDisplay.setDirections(response);
										var route = response.routes[0];
										var summaryPanel = document.getElementById('directions-panel');
										summaryPanel.innerHTML = '';
													
										// For each route, display summary information.
										for (var i = 0; i < route.legs.length; i++) {
											var routeSegment = i + 1;
											summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
											  '</b><br>';
											summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
											summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
											summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
										}
									} else {
										window.alert('Directions request failed due to ' + status);
									}
								});
							}

					        marker = new google.maps.Marker({
								position: new google.maps.LatLng({{ $latitude[$j] }}, {{ $longitude[$j] }}),
								map: map
							});

					        google.maps.event.addListener(marker, 'click', (function(marker) {
					        	return function () {
									infowindow.setContent('<div><strong>{{ $formatted_address[$j] }}</strong><br>' + 'Job Detail: {{$jobname[$j]["name"]}}' + '<br>{{ $formatted_address[$j] }}<br> Price: ${{$jobname[$j]["price"]}}' +  '</div>');
									infowindow.open(map, this);
								}
					        })(marker));
@php
   		 				}
   					}
   				}
   				else {
@endphp
			   		var pyrmont = {
					        lat: parseFloat('{{$latitude}}'),
					        lng: parseFloat('{{$longitude}}')
				        };       

				        map = new google.maps.Map(document.getElementById('map'), {
				            center: pyrmont,
				            zoom: 15,
				            mapTypeId: google.maps.MapTypeId.ROADMAP
				        });

				        infowindow = new google.maps.InfoWindow();
				        var service = new google.maps.places.PlacesService(map);

				        directionsDisplay.setMap(map);
						calculateAndDisplayRoute(directionsService, directionsDisplay);

				        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
							var waypts = [];

							waypts.push({
								location: '{{$inspection_address}}',
								stopover: true
							});

							directionsService.route({
								origin: '{{ $current_address }}',
								destination: '{{ $inspection_address }}',
								waypoints: waypts,
								optimizeWaypoints: true,
								travelMode: 'DRIVING',
								alternatives: true
							}, function(response, status) {
								if (status === 'OK') {
									directionsDisplay.setDirections(response);
									var route = response.routes[0];
									var summaryPanel = document.getElementById('directions-panel');
									summaryPanel.innerHTML = '';
												
									// For each route, display summary information.
									for (var i = 0; i < route.legs.length; i++) {
										var routeSegment = i + 1;
										summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
										  '</b><br>';
										summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
										summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
										summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
									}
								} else {
									window.alert('Directions request failed due to ' + status);
								}
							});
						}

				        
				        var marker = new google.maps.Marker({position: pyrmont, map: map});

				        service.getDetails({
							placeId: '{{$place_id}}'
				        }, function(place, status) {
				        	if (status === google.maps.places.PlacesServiceStatus.OK) {
						        

						        google.maps.event.addListener(marker, 'click', function() {
									infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + 'Job Detail: {{$jobname->name}}' + '<br>' + place.formatted_address  + '<br> Price: ${{$jobname->price}}' +  '</div>');
									infowindow.open(map, this);
						        });
						    }
				        });
@php 			} 
			} @endphp
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$GOOGLE_MAP_KEY}}&libraries=places&callback=initMap"></script>
@endsection