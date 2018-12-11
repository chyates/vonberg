<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MRZSS83');</script>
    <!-- End Google Tag Manager -->
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRZSS83"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-121418676-1');
    </script>
</head>

<body>
<div id="site-container" class="outer-container container-fluid">
    <?php 
        $nav_url = $_SERVER['REQUEST_URI'];
        if(strpos($nav_url, "users") != false) {
            echo $this->element('admin_nav');
        } else {
            echo $this->element('nav');
        }
    ?>

    <?= $this->fetch('content') ?>

    <?= $this->element('footer') ?>

</div><!-- site-container end -->

<?= $this->fetch('script') ?>
<script>


    jQuery(document).ready(function($){
        var lastA = $('.admin-nav').find('#users-dropdown');
        lastA.next().addClass('nav-link nav-item');
        // jQuery for CMS login + register screens
        var logForm = $("#site-container div.users.form");
        $(logForm).find("fieldset").find('a').first().css('display', 'none');

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

        let userTable = $("#site-container div.users.index");
        $(userTable).removeClass('large-10 medium-9 columns').addClass('inner-main inner-main table-responsive col-lg-8 col-12 mx-auto p-md-5 p-3');
        $(userTable).find('table').addClass('model-table table table-striped');
        $(userTable).find('table').find('th').addClass('model-table-header');
        $(userTable).find('table').find('td').addClass('model-table-data');
        $(userTable).find('table').find('td.actions a:first-child').css('display', 'none')

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
            if( $("#m-burger-nav #prod-drop").css('display') == 'block' ) {
                var arrow = $(this).find("span").find("img.mob-arrow");
                $(arrow).attr("src", "/img/Arrow-Down.svg");
            }
        });
    })

</script>
</body>
</html>