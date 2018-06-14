<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
    <title>Vonberg Valve, Inc.</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</head>

<body>
<div id="site-container" class="outer-container container-fluid">
    <?= $this->element('nav') ?>

    <?= $this->fetch('content') ?>

    <?= $this->element('footer') ?>

</div><!-- site-container end -->

<?= $this->fetch('script') ?>
<script>

    jQuery(document).ready(function($){
        $('.animated-icon1').click(function(){
            $(this).toggleClass('open');
        });

        $("a.nav-link").click(function(){
            // var open = $(this).find("a.nav-link:not(.collapsed)");
            // var collapsed = $(this).find("a.nav-link.collapsed");
            if( $("#m-burger-nav #prod-drop").css('display') == 'block' ) {
                console.log("Your dropdown is showing...");
                var arrow = $(this).find("span").find("img.mob-arrow");
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            }
            // if( $(this).hasClass('collapsed') ) {
            //     console.log("Found collapsed");
            //     $(arrow).attr("src", "/img/Arrow-Right.svg");
            // } else {
            // }
        });
    })
</script>
</body>
</html>