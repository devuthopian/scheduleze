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
	if(!empty($loca)){
		if(is_array($loca)){
			for ($i=0; $i < count($loca); $i++) {
				if(!empty($loca[$i])){

					$prepAddr = str_replace(' ','+',$loca[$i]->name);
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

			$prepAddr = str_replace(' ','+',$loca);
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
		<h4>Map for {!! get_field('users', 'name', $id) !!}</h4>
		<div id="map"></div>
	</div>
</div>
<!-- <script type="text/javascript" src="{{ URL::asset('js/mapmyday.js') }}"></script> -->

<script type="text/javascript">
	var map;
	var infowindow;

	function initMap() {
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
@php
			if(!empty($loca)){
				if(is_array($loca)){
@endphp
				    var pyrmont = {
				        lat: parseFloat('{{ $latitude[1] }}'),
				        lng: parseFloat('{{ $longitude[1] }}')
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
			        @php

			        for ($j = 0; $j < count($loca); $j++) {
			        	if(!empty($loca[$j])) {
			        		@endphp

					        function calculateAndDisplayRoute(directionsService, directionsDisplay, jobname, jobprice) {
								var waypts = [];
								@php for ($k = 1; $k < count($loca)-1; $k++) { @endphp
									waypts.push({
										location: '{{$formatted_address[$k]}}',
										stopover: true
									});
								@php } @endphp

								directionsService.route({
									origin: '{{$formatted_address[0]}}',
									destination: '{{$formatted_address[count($loca)-1]}}',
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
											//summaryPanel.innerHTML += '<div><strong>' + 'Job Detail: </strong><span class="jobnamespan">{{$jobname[$j]["name"]}}</span><br> Price: $<span class="jobspanprice">{{$jobname[$j]["price"]}}</span></div>';
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
				            zoom: 15
				        });

				        infowindow = new google.maps.InfoWindow();
				        var service = new google.maps.places.PlacesService(map);
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
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$GOOGLE_MAP_KEY}}&libraries=places&callback=initMap"></script>
@endsection