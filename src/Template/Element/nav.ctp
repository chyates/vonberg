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
            echo $this->Form->button('', ['class'=>'form-button']);
            // Match the search param in your table configuration
            echo $this->Form->end(); ?>
        </div>
    </nav><!-- home-top-header end -->
    <nav id="main-navbar" class="navbar navbar-expand-lg justify-content-end">
        <!-- Products Dropdown -->
        <div id="product-dropdown" class="dropdown">
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="/products">Products</a>
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
                        <p class="drop-header"><a href="/resources/application-information">Application Information</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Resources Dropdown -->
        <div id="resources-dropdown" class="dropdown">
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="/resources">Resources</a>
            <div class="dropdown-menu" aria-labelledby="product-dropdown">
                <div class="row no-gutters justify-content-between">
                    <p class="drop-header"><A HREF="/resources/general-information">General Information</A></p>
                    <p class="drop-header"><a href="/resources/technical-documentation">Technical Documentation</a></p>
                    <p class="drop-header"><a href="/resources/application-information">Application Information</a></p>
                    <p class="drop-header"><a href="/products/prices">Base Product Prices</a></p>
                    <p class="drop-header"><a href="/img/pdfs/catalog/VONBERG-Product_Catalog.pdf" download>Download Our Catalog</a></p>
                </div>
            </div>
        </div>
        <a class="nav-link nav-item" href="/about">About</a>
        <a class="nav-link nav-item" href="/locator">Find a Distributor</a>
        <a class="nav-link nav-item" href="/contact">Contact</a>
    </nav><!-- main-navbar end -->
</div> <!-- desktop-header end -->


<!-- Mobile Header Start -->
<div id="mobile-header" class="sticky-top">
    <div id="m-burger-nav" class=" wrapper-navbar"> <!-- Mobile Burger Menu Start -->
        <nav class="navbar">
            <a class="navbar-brand" href="/">
                <img class="header-image img-fluid" src="/img/vonberg-logo-white.svg" alt="Vonberg Valve, Inc">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-collapse" aria-controls="main-collapse"
            aria-expanded="false" aria-label="Toggle navigation"><div class="animated-icon1"><span></span><span></span><span></span></div></button>
            <div class="collapse navbar-collapse" id="main-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/products/new">New Products<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="prod-trigger nav-link" href="/products" data-toggle="collapse" data-target="#prod-drop">Products<span><img class="mob-arrow img-fluid" src="/img/Arrow-Right.svg"/></span></a>
                    </li>
                    <div id="prod-drop" class="collapse navbar-collapse">
                        <p class="drop-header"><A HREF="/products/catalog/1">Flow Regulating Valves</A></p>
                        <p class="drop-header"><A HREF="/products/catalog/2">Directional Valves</A></p>
                        <p class="drop-header"><A HREF="/products/catalog/3">Safety Valves</A></p>
                        <p class="drop-header"><A HREF="/products/catalog/5">Pressure Controls</A></p>
                        <p class="drop-header"><A HREF="/products/catalog/7">Cartridge Bodies</A></p>
                        <p class="drop-header"><A HREF="/products/customization">Product Customization</A></p>
                    </div>
                    <li class="nav-item">
                        <a class="resource-trigger nav-link" href="/resources" data-toggle="collapse" data-target="#resource-drop">Resources<span><img class="mob-arrow img-fluid" src="/img/Arrow-Right.svg"/></span></a>
                    </li>
                    <div id="resource-drop" class="collapse navbar-collapse">
                        <p class="drop-header"><A HREF="/resources/general-information">General Information</A></p>
                        <p class="drop-header"><a href="/resources/technical-documentation">Technical Documentation</a></p>
                        <p class="drop-header"><a href="/resources/application-information">Application Information</a></p>
                        <p class="drop-header"><a href="/products/prices">Base Product Prices</a></p>
                        <p class="drop-header"><a href="/img/pdfs/catalog/VONBERG-Product_Catalog.pdf" download>Download Our Catalog</a></p>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/locator">Find a Distributor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- #m-burger-nav end -->
</div><!-- mobile-header end -->
