<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
    <?php 
        // SEO implementation:
        $description = $this->fetch('description');
        if(empty($description)) {
            echo $this->Html->meta('description', 'Default description');
        }
        echo $description;

        $keywords = $this->fetch('keywords');
        if(empty($keywords)) {
            echo $this->Html->meta('keywords', 'Default keywords');
        }
        echo $keywords;

        $title = $this->fetch('title');
        if(empty($title)) {
            echo '<title>Vonberg Valve, Inc</title>';
        }
        echo '<title>' . $title . '</title>';
    ?>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121418676-1"></script>

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

<?= $this->fetch('script') ?>
<script>


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

        $('.animated-icon1').click(function(){
            $(this).toggleClass('open');
        });
        
        $('#markers_info .marker').hover(
            // mouse in
            function () {
                // first we need to know which <div class="marker"></div> we hovered
                var index = $('#markers_info .marker').index(this);
                window.gMarkers[index].setIcon(highlightedIcon());
            },
            // mouse out
            function () {
                // first we need to know which <div class="marker"></div> we hovered
                var index = $('#markers_info .marker').index(this);
                window.gMarkers[index].setIcon(normalIcon());
            }

        );

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