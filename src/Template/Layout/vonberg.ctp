<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="DCnLvQCdBvmiO6P7IrbPsh9uWkoH2BRh-IBnIxKwqDA" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
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
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-121418676-1');
    </script>
</head>

<body>
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

<!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCeCUFNTzQXY_J_HYtw6JAhr6fyCl5RoZE"></script> -->

<script type="text/javascript">
  var onloadCallback = function() {
    console.log("grecaptcha is ready!");
  };
</script>

<?php echo $this->Html->script('/js/jquery.geocomplete.min.js');?>

<script>
    jQuery(document).ready(function($){
        // add divs for bootstrap validation
        var feedback = '<div class="invalid-feedback">This field is required.</div>';
        $("#contact-form textarea:not(#g-recaptcha-response)").after(feedback);
        $("#contact-form input").each(function(index) {
            $(this).after(feedback)
        });

        // add form-group class to trigger validations
        $("#contact-form .input").not("#contact-form .input.checkbox").addClass('form-group');

        // format checkboxes + submit row
        var rowLabel = $("#contact-form div.select").find("label").first();
        rowLabel.next("input[type=hidden]").wrapAll('<div class="row no-gutters" />');

        var submit = $("#contact-form div.submit");
        submit.addClass('col-6 text-right');
        submit.find('input[type=submit]').addClass('btn btn-primary');

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
            var divID = $(this).attr('id');
            $(".gmnoprint").each(function(index) {
                // console.log("Each marker id: ", $(this).attr('id'));
                // console.log("Each marker img src: ", $(this).find("img").attr('src'));
                var mIcon = $(this).find('img');
                if(divID == index) {
                    // $(mIcon).attr('src', '/img/pin-selected.png');
                    console.log("Icon img src: ", $(mIcon).attr('src'));
                    var highlightDiv = $('div.marker[id*="'+index+'"]');
                    console.log($(highlightDiv).html());
                    highlightDiv.toggleClass('marker-unselected marker-selected');
                }
            })
            $(this).toggleClass('marker-unselected').toggleClass('marker-selected');
            var toggleDivs = $("div.marker.marker-selected").not(this);
            // var togglePins = $('#markers_info .marker.marker-selected').not(this).index();
            toggleDivs.toggleClass('marker-selected').toggleClass('marker-unselected');
            // window.gMarkers[togglePins].setIcon(normalIcon());
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