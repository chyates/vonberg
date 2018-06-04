<div id="desktop-header">
    <nav id="home-top-header" class="navbar navbar-expand-lg justify-content-between">
        <a class="navbar-brand" href="/">
            <img class="header-image img-fluid" src="/img/Vonberg-Logo.svg" alt="">
        </a>
        <div class="d-flex flex-row justify-content-end">
            <a class="header-link nav-link" href="/products/new">New Products</a>
            <?php echo $this->Form->create(null, ['class'=>'form-inline','valueSources' => 'query','url' => ['controller' => 'Products', 'action' => 'search']]);
            // You'll need to populate $authors in the template from your controller
            echo $this->Form->control('q', ['label' => false,'type' => 'search','class'=>'form-control', 'placeholder'=>'Search by product number or keyword','aria-label'=>'Search']);
            // Match the search param in your table configuration
            echo $this->Form->end(); ?>
        </div>
    </nav><!-- home-top-header end -->
    <nav id="main-navbar" class="navbar navbar-expand-lg justify-content-end">
        <!-- Products Dropdown -->
        <div id="product-dropdown" class="dropdown">
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
            <div class="dropdown-menu" aria-labelledby="product-dropdown">
                <div class="row no-gutters justify-content-between">
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/1">Flow Regulating Valves</A></p>
                        <p class="drop-content">Flow Regulators</p>
                        <p class="drop-content">Flow Dividers & Combiners</p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/2">Directional Valves</A></p>
                        <p class="drop-content">Check Valves - Poppet</p>
                        <p class="drop-content">Check Valves - Ball</p>
                        <p class="drop-content">Shuttle Valves</p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/3">Safety Valves</A></p>
                        <p class="drop-content">Velocity Fuses</p>
                        <p class="drop-content">Flow Limiters</p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/5">Pressure Controls</A></p>
                        <p class="drop-content">Counterbalance Valves</p>
                        <p class="drop-content">Relief Valves - Direct Acting</p>
                        <p class="drop-content">Relief Valves - Differential Area</p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/7">Cartridge Bodies</A></p>
                        <p class="drop-content">2-Way Manifolds</p>
                        <p class="drop-content">3-Way Manifolds</p>
                        <p class="drop-content">3-Way T-Series Manifolds</p>
                        <p class="drop-content">Cavity Plugs</p>
                    </div>
                    <div class="col last-prod-drop">
                        <p class="drop-header"><A HREF="/products/customization">Product Customization</A></p>
                        <p class="drop-header">Application Information</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Resources Dropdown -->
        <div id="resources-dropdown" class="dropdown">
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Resources</a>
            <div class="dropdown-menu" aria-labelledby="product-dropdown">
                <div class="row no-gutters justify-content-between">
                    <p class="drop-header"><A HREF="/resources">General Information</A></p>
                    <p class="drop-header">Technical Documentation</p>
                    <p class="drop-header">Application Information</p>
                    <p class="drop-header"><a href="/products/prices">Base Product Prices</a></p>
                    <p class="drop-header">Download Our Catalog</p>
                </div>
            </div>
        </div>
        <a class="nav-link nav-item" href="/about">About</a>
        <a class="nav-link nav-item" href="/locator">Find a Distributor</a>
        <a class="nav-link nav-item" href="/contact">Contact</a>
    </nav><!-- main-navbar end -->
</div> <!-- desktop-header end -->
<!-- Mobil Header Start -->
<div id="mobile-header">
    <div id="m-burger-nav" class="sticky-top wrapper-navbar"> <!-- Mobile Burger Menu Start -->
        <nav class="sticky-top navbar">
            <a class="navbar-brand" href="/">
                <img class="header-image img-fluid" src="/img/vonberg-logo-white.svg" alt="Vonberg Valve, Inc">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20" aria-controls="navbarSupportedContent20"
            aria-expanded="false" aria-label="Toggle navigation"><div class="animated-icon1"><span></span><span></span><span></span></div></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent20">
                <ul class="navbar-nav mr-auto">
                    <li class="hero-text-w nav-item active">
                        <a class="nav-link" href="/capabilities">Capabilities<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="hero-text-w nav-item">
                        <a class="nav-link" href="/philosophy">Philosophy</a>
                    </li>
                    <li class="hero-text-w nav-item">
                        <a class="nav-link" href="/careers">Careers</a>
                    </li>
                    <li class="hero-text-w nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="hero-text-w nav-item">
                        <a class="nav-link" href="/request-a-quote">Request a Quote</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- #m-burger-nav end -->
</div><!-- mobile-header end -->
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.animated-icon1').click(function(){
        $(this).toggleClass('open');
    });
});  
</script>