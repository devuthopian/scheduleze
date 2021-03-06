/*function initMap() {
	var center = {lat: 41.8781, lng: -87.6298};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: center
	});
	var marker = new google.maps.Marker({
		position: center,
		map: map
	});
}*/
     // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;




      function initMap() {
        var pyrmont = {lat: $latitude, lng: $longitude};

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

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
	/*function initMap() {
		var markerArray = [];

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on India.
        var map = new google.maps.Map(document.getElementById('map'), {
        	zoom: 13,
        	center: {lat: 31.3866, lng: 76.3550}
        });

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;

        setTimeout(function(){
	        // Display the route between the initial start and end selections.
	        calculateAndDisplayRoute(
	        	directionsDisplay, directionsService, markerArray, stepDisplay, map);
        }, 900);
        // Listen to change events from the start and end lists.
    }

    function calculateAndDisplayRoute(directionsDisplay, directionsService,
    	markerArray, stepDisplay, map) {
        // First, remove any existing markers from the map.
        for (var i = 0; i < markerArray.length; i++) {
        	markerArray[i].setMap(null);
        }

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
        	origin: 'geeta mandir, sector 2, naya nangal, India',
        	destination: 'Madhuvan Park, Sector 2, Naya Nangal, India',
        	travelMode: 'WALKING'
        }, function(response, status) {
          // Route the directions and pass the response to a function to create
          // markers for each step.
          if (status === 'OK') {
          	document.getElementById('warnings-panel').innerHTML =
          	'<b>' + response.routes[0].warnings + '</b>';
          	directionsDisplay.setDirections(response);
          	showSteps(response, markerArray, stepDisplay, map);
          } else {
          	window.alert('Directions request failed due to ' + status);
          }
      });
    }

    function showSteps(directionResult, markerArray, stepDisplay, map) {
        // For each step, place a marker, and add the text to the marker's infowindow.
        // Also attach the marker to an array so we can keep track of it and remove it
        // when calculating new routes.
        var myRoute = directionResult.routes[0].legs[0];
        for (var i = 0; i < myRoute.steps.length; i++) {
        	var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
        	marker.setMap(map);
        	marker.setPosition(myRoute.steps[i].start_location);
        	attachInstructionText(
        		stepDisplay, marker, myRoute.steps[i].instructions, map);
        }
    }

    function attachInstructionText(stepDisplay, marker, text, map) {
    	google.maps.event.addListener(marker, 'click', function() {
          // Open an info window when the marker is clicked on, containing the text
          // of the step.
          stepDisplay.setContent(text);
          stepDisplay.open(map, marker);
      });
    }*/
