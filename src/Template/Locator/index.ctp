<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div id="find-distributor-main" class="inner-main col-lg-10 col-12 mx-auto p-sm-5 p-3">
    <div class="row">
        <div class="col-md-5 col-sm-10 mx-sm-auto left-search">
            <h1 class="page-header">Find a Distributor</h1>
            <p class="product-info">Enter Zip Code</p>
            <?php 
                echo $this->Form->create('Locator', array(
                    'url' => array('action' => 'index'),
                    'class' => 'form-inline details', 
                    'id' => 'dist-form', 
                    'enctype' => 'multipart/form-data'
                ));

                echo $this->Form->input('zip', array(
                    'class' => 'form-control',
                    'label'=> false,
                    'type' => 'text',
                    'id' => 'geocomplete'
                ));

                echo $this->Form->submit('Search', array('class' => 'btn btn-primary'));
                
                echo $this->Form->end();
            ?>
            <p class="miles-text">Results within 200 miles</p>
            <div class="search-block mt-2 p-4 d-flex" style="height: 300px; overflow-y : scroll;">
            <?php
                if (!empty($query)) {
                    echo '<div id="markers_info">';
                    $u_id = 1;
                    foreach ($query as $dealer): ?>
                        <div id="<?= $u_id ?>" class="marker marker-unselected" onclick="toggleDivs(document.getElementById(<?= $u_id ?>))">
                            <h4><?= h($dealer->name) ?></h4>
                            <div class="row no-gutters">
                                <div class="col-8">
                                    <?php
                                        if ($dealer->address1):
                                            echo '<p>'. strtolower($dealer->address1) .'</p>';
                                        endif;

                                        if ($dealer->address2):
                                            echo '<p>'. strtolower($dealer->address2) .'</p>';
                                        endif;
                                    ?>
                                    <p>
                                        <?php 
                                            echo strtolower(h($dealer->city)) . ", ";
                                            echo (h($dealer->state)) . " ";
                                            if(strlen(h($dealer->zip)) == 4) {
                                                $w_zero = "0" . strtolower(h($dealer->zip));
                                                echo $w_zero;
                                            } else {
                                                echo strtolower(h($dealer->zip)); 
                                            }
                                        ?>
                                    </p>
                                    <?php
                                        if ($dealer->website):
                                            echo '<p><a class="results-link" href="'.$dealer->website.'">'. strtolower($dealer->website) .'</a></p>';
                                        endif;
                                    ?>
                                </div>
                                <div class="col-4">
                                    <?php
                                    if ($dealer->telephone):
                                        echo '<p>P: '. preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $dealer->telephone) .'</p>';
                                    endif;
                                    ?>
                                    <?php
                                        if ($dealer->fax):
                                            echo '<p>F: '. preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $dealer->fax) .'</p>';
                                        endif;

                                    ?>
                                    <p><a class="results-link" href=<?="https://www.google.com/maps?saddr=My+Location&daddr=" . $dealer->lat . "," . $dealer->lng; ?> target="_new">Get directions ></a></p>
                                </div>
                            </div>
                        </div>
                <?php 
                    $u_id++;
                    endforeach;
                    echo '</div>';
                    }  else { 
                ?>
                    <div class="empty-query my-auto mx-auto">
                        <p class="search-text-default">Use the search bar above to find distributors in your area.</p>
                    </div>
              <?php  } ?>
            </div>
        </div><!-- .left-search end -->

        <div class="col-md-7 col-10 mx-sm-auto my-lg-0 my-sm-3 right-map">
            <div id="map"></div>
            <script>
                var results = <?php echo json_encode($query); ?>
                // functions that return icons.  Make or find your own markers.
                // function normalIcon() {
                //     return {
                //         url: '/img/pin-unselected.png'
                //     };
                // }

                // function highlightedIcon() {
                //     return {
                //         url: '/img/pin-selected.png'
                //     };
                // }

                // intialize map
                var map, infoWindow;
                var markerArr = [];
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: { lat: 42.095891, lng: -88.029229 },
                        zoom: 6
                    });
                    infoWindow = new google.maps.InfoWindow;

                    // center map after search results are populated
                    if(results.length > 0) {
                        //create empty LatLngBounds object
                        var bounds = new google.maps.LatLngBounds();
                        var infowindow = new google.maps.InfoWindow();    

                        for (i = 0; i < results.length; i++) {
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(results[i]['lat'], results[i]['lng']),
                                map: map,
                                icon: '/img/pin-unselected.png', 
                                id: i+1,
                                active: false
                            });
                            markerArr.push(marker);

                            //extend the bounds to include each marker's position
                            bounds.extend(marker.position);

                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                    infowindow.setContent(results[i][0]);
                                    for(j = 0; j < markerArr.length; j++) {
                                        if(markerArr[j].active == true) {
                                            markerArr[j].active = false;
                                            markerArr[j].setIcon("/img/pin-unselected.png")
                                        }
                                    }

                                    marker.setIcon("/img/pin-selected.png");
                                    marker.active = true

                                    var searchID = marker.id;
                                    var highDiv = document.getElementById(searchID);
                                    var theRest = document.getElementsByClassName('marker');

                                    Array.from(theRest).forEach(function(item) {
                                        highDiv.scrollIntoView(true)
                                        highDiv.scrollIntoView( { behavior: 'smooth'} )
                                        if(item.className.includes('marker-selected')) {
                                            item.classList.remove('marker-selected')
                                            item.classList.add('marker-unselected')
                                        }
                                    });

                                    highDiv.classList.remove('marker-unselected');
                                    highDiv.classList.add("marker-selected");
                                }
                            })(marker, i));
                        }

                        //now fit the map to the newly inclusive bounds
                        map.fitBounds(bounds);

                        //(optional) restore the zoom level after the map is done scaling
                        var listener = google.maps.event.addListener(map, "idle", function () {
                            map.setZoom(6);
                            google.maps.event.removeListener(listener);
                        }); 
                    } else {
                        // center map on user's current location
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
                }

                function toggleDivs(div) {
                    var all = document.getElementsByClassName('marker')
                    for(x = 0; x < all.length; x++) {
                        if(all[x].className.includes('marker-selected')) {
                            all[x].classList.remove('marker-selected')
                            all[x].classList.add('marker-unselected')
                        }
                    }

                    for(k = 0; k < markerArr.length; k++) {
                        if(markerArr[k].id == div.id) {
                            markerArr[k].setIcon("/img/pin-selected.png");
                            markerArr[k].active = true
                        } else {
                            markerArr[k].setIcon("/img/pin-unselected.png")
                            markerArr[k].active = false
                        }
                    }

                    div.classList.remove('marker-unselected')
                    div.classList.add('marker-selected')
                }

                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                }

                jQuery(document).ready(function($) {
                    console.log("jQuery loaded inside locator index file");

                    $("div.marker").click(function(){
                        console.log("ID:", $(this).attr('id'));
                    });
                    
                    if($("div.marker").hasClass('marker-selected')){

                    }
                })
            </script>
            <script async defer src="//maps.googleapis.com/maps/api/js?key=AIzaSyCeCUFNTzQXY_J_HYtw6JAhr6fyCl5RoZE&callback=initMap" type="text/javascript"></script>
        </div>
    </div>
</div><!-- #find-distributor-main end -->