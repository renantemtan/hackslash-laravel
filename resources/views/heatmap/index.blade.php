@extends('layouts.app')

@section('content')
    <div id="map"></div>
@endsection

@section('custom_javascript')
    <script>
        var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('{{ route('fetch') }}', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}


        //testing failed
        
        // fetch("{{ route('fetch') }}").then( response => response.json() ).then( response => {
        //   response.forEach(function(result){
        //       console.log(result.latitude);
        //   })
        // })
        // // Note: This example requires that you consent to location sharing when
        // // prompted by your browser. If you see the error "The Geolocation service
        // // failed.", it means you probably did not give permission for the browser to
        // // locate you.
        // var map, infoWindow;
        
        // function initMap() {
        //     map = new google.maps.Map(document.getElementById('map'), {
        //         center: {lat: -34.397, lng: 150.644},
        //         zoom: 6
        //     });
        //     infoWindow = new google.maps.InfoWindow;
            
            
        //     // Try HTML5 geolocation.
        //     if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(function(position) {
        //         var pos = {
        //         lat: position.coords.latitude,
        //         lng: position.coords.longitude
        //         };
        //     var marker = new google.maps.Marker({position: pos, map: map});
        //     map.setCenter(pos);
        //     }, function() {
        //         handleLocationError(true, infoWindow, map.getCenter());
        //     });
        //     } else {
        //         // Browser doesn't support Geolocation
        //         handleLocationError(false, infoWindow, map.getCenter());
        //     }
        //     }
        
        // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        //     infoWindow.setPosition(pos);
        //     infoWindow.setContent(browserHasGeolocation ?
        //     'Error: The Geolocation service failed.' :
        //     'Error: Your browser doesn\'t support geolocation.');
        //     infoWindow.open(map);
        // }
        // </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsw3naNQ-tGFTQzOS2-ClL8NWbc4yz1zI&callback=initMap">
    </script>
@stop

@section('custom_style')
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        position: relative;
        left: 15%;
        height: 50%;
        width: 75%
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
@stop
