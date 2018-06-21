<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
    <title>Vonberg Valve, Inc.</title>
    <style>
        #markers_info .marker {
            height: auto;
            cursor: pointer;
        }
    </style>

</head>

<body onLoad="initGeolocation();">
<div id="site-container" class="outer-container container-fluid">
    <?= $this->element('nav') ?>

    <?= $this->fetch('content') ?>

    <?= $this->element('footer') ?>

</div><!-- site-container end -->

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/paulkinzett/toolbar@1.0.1/jquery.toolbar.js"></script>

<?= $this->fetch('script') ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA0lVHjz_FEwUJzVwn6rTIMEyYUTHot7EY"></script>

<?php echo $this->Html->script('/js/jquery.geocomplete.min.js');?>

<script>
    // functions that return icons.  Make or find your own markers.
    function normalIcon() {
        return {
            url: '/img/pin-unselected.png'
        };
    }
    function highlightedIcon() {
        return {
            url: '/img/pin-selected.png'
        };
    }

     $(function(){
         $("#geocomplete").geocomplete({ details: "form" })
     });

    jQuery(document).ready(function($){
        $('.animated-icon1').click(function(){
            $(this).toggleClass('open');
        });

        if($("#find-distributor-main").find(".left-search .search-block").find(".empty-query").css('display') == 'block') {
            $(this).css('background-color', '#F9F9F7');
        } else {
            $(this).css('background-color', '#FFFFFF');
        }

        $(".marker").click(function(){
            $(this).toggleClass('marker-unselected', 'marker-selected');
        })

        $("a.prod-trigger.nav-link").click(function(){
            var arrow = $(this).find("span").find("img.mob-arrow");
            if( !$("#prod-drop").hasClass('show') ) {
                console.log("Your dropdown is showing...");
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            } else {
                $(arrow).attr("src", "/img/Arrow-Right.svg");
            }
        });

        $("a.resource-trigger.nav-link").click(function(){
            var arrow = $(this).find("span").find("img.mob-arrow");
            if( !$("#resource-drop").hasClass('show') ) {
                console.log("Your dropdown is showing...");
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            } else {
                $(arrow).attr("src", "/img/Arrow-Right.svg");
            }

            // if( $("#m-burger-nav #resource-drop").css('display') !== 'block' ) {
            //     console.log("Your dropdown is showing...");
            //     $(arrow).attr("src", "/img/Arrow-Down.svg");
            // } else {
            //     $(arrow).attr("src", "/img/Arrow-Right.svg");
            // }
        });

        var form = $("#find-distributor-main .form-inline");
        form.find("div.input.text").addClass('col-8');
        form.find("div.submit").addClass('col-4');

        // Marker hover for locator map
        $('#markers_info .marker').hover(
            // mouse in
            function () {
                // first we need to know which <div class="marker"></div> we hovered
                var index = $('#markers_info .marker').index(this);
                gMarkers0[index].setIcon(highlightedIcon());
            },
            // mouse out
            function () {
                // first we need to know which <div class="marker"></div> we hovered
                var index = $('#markers_info .marker').index(this);
                gMarkers0[index].setIcon(normalIcon());
            }

        );

        var carousel = $('#hero-slider');
        var backgrounds = [
        'url(/img/Homepage-hero-1@2x-min.png)', 
        'url(/img/Homepage-hero-2@2x-min.png)', 
        'url(/img/Homepage-hero-3@2x-min.png)'];
        var current = 0;

        function nextBackground() {
            carousel.css(
                'background-image',
            backgrounds[current = ++current % backgrounds.length]);

            setTimeout(nextBackground, 5000);
        }
        setTimeout(nextBackground, 5000);
        carousel.css('background-image', backgrounds[0]);
    });  
</script>
<script type="text/javascript">
    function initGeolocation()
    {
        if( navigator.geolocation )
        {
            // Call getCurrentPosition with success and failure callbacks
            navigator.geolocation.getCurrentPosition( success, fail );
        }
        else
        {
            alert("Sorry, your browser does not support geolocation services.");
        }
    }

    function success(position)
    {

        document.getElementById('lng').value = position.coords.longitude;
        document.getElementById('lat').value = position.coords.latitude
    }

    function fail()
    {
        // Could not obtain location
    }

</script>
</body>
</html>