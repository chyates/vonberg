<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Vonberg Valve, Inc.</title>
</head>

<body>
<div id="site-container" class="outer-container container-fluid">
    <?= $this->element('nav') ?>

    <?= $this->fetch('content') ?>

    <?= $this->element('footer') ?>

</div><!-- site-container end -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script>
    // $(function(){
    //     $("#geocomplete").geocomplete({ details: "form" })
    // });

    jQuery(document).ready(function($){
        $('.animated-icon1').click(function(){
            $(this).toggleClass('open');
        });

        if( $("#mobile-header #m-burger-nav #prod-drop").hasClass('show') ) {
            $(this).closest("li.nav-item").find("img.mob-arrow").attr("src", "/img/Arrow-Down.svg");
        } else {
            $(this).closest("img.mob-arrow").attr("src", "/img/Arrow-Right.svg");
        }

        var carousel = $('#hero-slider');
        var backgrounds = [
        'url(/img/Homepage-hero-1@2x-min.png)', 
        'url(/img/Homepage-hero-2@2x-min.png)', 
        'url(/img/Homepage-hero-3@2x-min.png)'];
        var current = 0;

        function nextBackground() {
            carousel.css(
                'background',
            backgrounds[current = ++current % backgrounds.length]);

            setTimeout(nextBackground, 5000);
        }
        setTimeout(nextBackground, 5000);
        carousel.css('background-image', backgrounds[0]);
    });  
</script>
</body>
</html>