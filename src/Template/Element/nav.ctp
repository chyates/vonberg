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
                    <p class="drop-header"><A HREF="/products/catalog/6">Product Customization</A></p>
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
                <p class="drop-header">Base Product Prices</p>
                <p class="drop-header">Download Our Catalog</p>
            </div>
        </div>
    </div>
    <a class="nav-link nav-item" href="/about">About</a>
    <a class="nav-link nav-item" href="/locator">Find a Distributor</a>
    <a class="nav-link nav-item" href="/contact">Contact</a>
</nav><!-- main-navbar end -->