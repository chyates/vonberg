<div id="desktop-header">
    <nav id="home-top-header" class="navbar navbar-expand-lg justify-content-between">
        <a class="navbar-brand" href="/">
            <img class="header-image img-fluid" src="/img/Vonberg-Logo.svg" alt="">
        </a>
        <div class="d-flex flex-row justify-content-end">
            <a class="header-link nav-link" href="/products/new">New Products</a>
            <?= $this->Form->create('site-search', 
                [
                    'class'=>'form-inline',
                    'url' => ['controller' => 'Products', 'action' => 'search']
                ]); ?>
                <?php echo $this->Form->control('lookup', 
                [
                    'label' => false,
                    'type' => 'search',
                    'class'=>'form-control', 
                    'placeholder'=>'Search by product number or keyword'
                ]);
                echo $this->Form->button('', ['type' => 'submit', 'class'=>'form-button']);
                echo $this->Form->end(); 
                ?>
        </div>
    </nav><!-- home-top-header end -->
    <nav id="main-navbar" class="navbar navbar-expand-lg justify-content-end">
        <!-- Products Dropdown -->
        <div id="product-dropdown" class="dropdown">
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" href="/products">Products</a>
            <div class="dropdown-menu" aria-labelledby="product-dropdown">
                <div class="row no-gutters justify-content-between">
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/1">Flow Regulating Valves</A></p>
                        <p class="drop-content"><a href="/products/type/8">Flow Dividers & Combiners</a></p>
                        <p class="drop-content"><a href="/products/type/6">Flow Regulators</a></p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/2">Directional Valves</A></p>
                        <p class="drop-content"><a href="/products/type/9">Check Valves - Ball</a></p>
                        <p class="drop-content"><a href="/products/type/7">Check Valves - Poppet</a></p>
                        <p class="drop-content"><a href="/products/type/10">Shuttle Valves</a></p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/3">Safety Valves</A></p>
                        <p class="drop-content"><a href="/products/type/12">Flow Limiters</a></p>
                        <p class="drop-content"><a href="/products/type/11">Velocity Fuses</a></p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/5">Pressure Controls</A></p>
                        <p class="drop-content"><a href="/products/type/15">Counterbalance Valves</a></p>
                        <p class="drop-content"><a href="/products/type/14">Relief Valves - Differential Area</a></p>
                        <p class="drop-content"><a href="/products/type/13">Relief Valves - Direct Acting</a></p>
                    </div>
                    <div class="col">
                        <p class="drop-header"><A HREF="/products/catalog/7">Cartridge Bodies</A></p>
                        <p class="drop-content"><a href="/products/type/24">2-Way Manifolds</a></p>
                        <p class="drop-content"><a href="/products/type/22">3-Way Manifolds</a></p>
                        <p class="drop-content"><a href="/products/type/19">3-Way T-Series Manifolds</a></p>
                        <p class="drop-content"><a href="/products/type/30">Cavity Plugs</a></p>
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
            <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" href="/resources">Resources</a>
            <div class="dropdown-menu" aria-labelledby="product-dropdown">
                <div class="row no-gutters justify-content-between">
                    <p class="drop-header"><A HREF="/resources/general-information">General Information</A></p>
                    <p class="drop-header"><a href="/resources/technical-documentation">Technical Documentation</a></p>
                    <p class="drop-header"><a href="/resources/application-information">Application Information</a></p>
                    <p class="drop-header"><a href="/products/prices">Base Product Prices</a></p>
                    <!-- <p class="drop-header"><a href="/img/pdfs/catalog/VONBERG-Product_Catalog.pdf" target="_blank">Download Our Catalog</a></p> -->
                    <p class="drop-header"><a id="download-catalog">Download Our Catalog</a></p>
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
            <div class="navbar-brand" href="/">
                <a href="/">
                    <img class="header-image img-fluid" src="/img/vonberg-logo-white.svg" alt="Vonberg Valve, Inc" id="mobileLogo">
                </a>
                <div class="mobile-search-bar mobile-hidden d-flex flex-row justify-content-end" id="mobileSearchBar">
                    <?php echo $this->Form->create(null, ['class'=>'form-inline','valueSources' => 'query','url' => ['controller' => 'Products', 'action' => 'search']]);
                    // You'll need to populate $authors in the template from your controller
                    echo $this->Form->control('q', ['label' => false,'type' => 'search','class'=>'form-control', 'placeholder'=>'Search by product number or keyword','aria-label'=>'Search']);
                    echo $this->Form->button('', ['class'=>'form-button']);
                    // Match the search param in your table configuration
                    echo $this->Form->end(); ?>
                </div>
                </div>
            
            <div class="mobile-search-button">
                <img src="/img/Search-icon.svg" onclick="searchHide(); titleHide()">
            </div>

            <script>
                function searchHide() {
                    var element = document.getElementById("mobileSearchBar");
                    element.classList.remove("mobile-hidden");
                }
                function titleHide() {
                    var element = document.getElementById("mobileLogo");
                    element.classList.add("mobile-hidden");
                }
            </script>

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
                        <!-- <p class="drop-header"><a href="/img/pdfs/catalog/VONBERG-Product_Catalog.pdf" download>Download Our Catalog</a></p> -->
                        <p class="drop-header"><a id="download-catalog">Download Our Catalog</a></p>
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

<script>
document.querySelectorAll('#download-catalog').forEach(link => {
    link.onclick = downloadCatalog
})
</script>
