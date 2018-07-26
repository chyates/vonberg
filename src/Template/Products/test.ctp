<?php
    $options = [
        'zoom' => 6,
        'type' => 'R',
        'unitSystem'=> 'UnitSystem.IMPERIAL',
        'geolocate' => true,
        'div' => ['id' => 'map'],
        'map' => ['navOptions' => ['style' => 'SMALL']]
    ];

    $map =  $this->GoogleMap->map($options);
    echo $map;
    
    if (isset($query)) {
        foreach ($query as $dealer):
            $this->GoogleMap->addMarker(['lat' => $dealer->lat, 'lng' => $dealer->lng, 'title' => $dealer->name, 'content' => $dealer->address, 'icon' => '/img/pin-unselected.png']);

        endforeach;
    }
    $this->GoogleMap->finalize()
?>

<div id="map" style="height: 725px;" ></div>

<script type="text/javascript">
var map, infoWindow;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 6
    });
    infoWindow = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
        };
        map.setCenter(pos);
    }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
    });
    } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
} 
</script>

$directions_url = 'https://www.google.com/maps/dir/?api=1&origin='.$lat.','.$lng.'&destination='.$dealer->lat.','.$dealer->lng;