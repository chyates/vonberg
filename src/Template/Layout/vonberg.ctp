<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="DCnLvQCdBvmiO6P7IrbPsh9uWkoH2BRh-IBnIxKwqDA" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
    <style>
        #markers_info .marker {
            height: auto;
            cursor: pointer;
        }
    </style>
    <?php 
        // SEO implementation:
        $description = $this->fetch('description');
        if(empty($description)) {
            echo $this->Html->meta('description', 'Choose the highest-quality hydraulic valves. Vonberg is proud to design, manufacture, assemble and test hydraulic valves, cartridge style valves, integrated manifolds, cartridge bodies and more. We’ve been a family owned company dedicated to hydraulic innovation since 1971.');
        }
        echo $description;

        $keywords = $this->fetch('keywords');
        if(empty($keywords)) {
            echo $this->Html->meta(
                'keywords', 
                'Vonberg Valve');
        }
        echo $keywords;

        $title = $this->fetch('title');
        if(empty($title)) {
            echo '<title>Vonberg Valve, Inc</title>';
        }
        echo '<title>' . $title . '</title>';
    ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121418676-1"></script>

    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-121418676-1');
    </script>
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
        // jQuery for CMS login + register screens
        var logForm = $("#site-container div.users.form");
        logForm.addClass('inner-main col-lg-8 col-12 mx-auto p-md-5 p-3');
        logForm.find('form').addClass('col-6 mx-auto');
        var notChecks = logForm.find('div.input:not(.checkbox)');
        notChecks.addClass('form-group');
        notChecks.find('input').addClass('form-control');
        var checks = logForm.find('div.checkbox');
        checks.addClass('form-check');
        checks.find('label').addClass('form-check-label');
        checks.find('input').addClass('form-check-input');
        logForm.find('button').addClass('btn btn-primary');

        // jQuery for mobile hamburger menu
        $('.animated-icon1').click(function(){
            $(this).toggleClass('open');
        });

        // jQuery for distributor page
        var emptyBlock = $("#find-distributor-main .left-search .search-block .empty-query");
        if(emptyBlock.css('display') == 'block') {
            emptyBlock.parent().css('background-color', '#F9F9F7');
        } else {
            emptyBlock.parent().css('background-color', '#FFFFFF');
        }

        $("div.marker").click(function(){
            var index = $('#markers_info .marker').index(this);
            gMarkers0[index].setIcon(highlightedIcon());
            $(this).toggleClass('marker-unselected').toggleClass('marker-selected');
            var toggleDivs = $("div.marker.marker-selected").not(this);
            var togglePins = $('#markers_info .marker.marker-selected').not(this).index();
            toggleDivs.toggleClass('marker-selected').toggleClass('marker-unselected');
            gMarkers0[togglePins].setIcon(normalIcon());
        });

        var form = $("#find-distributor-main .form-inline");
        form.find("div.input.text").addClass('col-8');
        form.find("div.submit").addClass('col-4');

        // jQuery for product + resources submenus in hamburger
        $("a.prod-trigger.nav-link").click(function(){
            var arrow = $(this).find("span").find("img.mob-arrow");
            if( !$("#prod-drop").hasClass('show') ) {
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            } else {
                $(arrow).attr("src", "/img/Arrow-Right.svg");
            }
        });

        $("a.resource-trigger.nav-link").click(function(){
            var arrow = $(this).find("span").find("img.mob-arrow");
            if( !$("#resource-drop").hasClass('show') ) {
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            } else {
                $(arrow).attr("src", "/img/Arrow-Right.svg");
            }
        });

        // jQuery to cycle through home hero images
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