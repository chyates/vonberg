<nav id="home-top-header" class="navbar navbar-expand-lg justify-content-between">
    <a class="navbar-brand" href="/admin">
        <img class="header-image img-fluid" src="/img/Vonberg-Logo.svg" alt="">
    </a>
    <div class="d-flex flex-row justify-content-end">
        <a class="header-link nav-link" href="/admin/new">New Products</a>
        <p class="cms-top-nav mx-2 my-auto"><a href="/admin/add-product">Add New Product</a></p>
        <p class="cms-top-nav mx-2 my-auto"><a href="/admin/generate-pdf">Generate Custom PDF</a></p>
        <p class="cms-top-nav mx-2 my-auto"><a href="/admin/model-pricing">Model Pricing</a></p>
        <p class="cms-top-nav mx-2 my-auto"><a href="/admin/download-stp">STP Download Report</a></p>
    </div>
</nav><!-- home-top-header end -->

<nav id="main-navbar" class="admin-nav navbar navbar-expand-lg justify-content-end">
    <!-- Products Dropdown -->
    <div id="product-dropdown" class="dropdown">
        <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" href="/admin/products">Products</a>
        <div class="dropdown-menu" aria-labelledby="product-dropdown">
            <div class="row no-gutters justify-content-between">
                <div class="col">
                    <p class="drop-header"><a href="/admin/catalog/1">Flow Regulating Valves</a></p>
                    <p class="drop-content"><a href="/admin/type/8">Flow Dividers & Combiners</a></p>
                    <p class="drop-content"><a href="/admin/type/6">Flow Regulators</a></p>
                </div>
                <div class="col">
                    <p class="drop-header"><a href="/admin/catalog/2">Directional Valves</a></p>
                    <p class="drop-content"><a href="/admin/type/9">Check Valves - Ball</a></p>
                    <p class="drop-content"><a href="/admin/type/7">Check Valves - Poppet</a></p>
                    <p class="drop-content"><a href="/admin/type/10">Shuttle Valves</a></p>
                </div>
                <div class="col">
                    <p class="drop-header"><a href="/admin/catalog/3">Safety Valves</a></p>
                    <p class="drop-content"><a href="/admin/type/12">Flow Limiters</a></p>
                    <p class="drop-content"><a href="/admin/type/11">Velocity Fuses</a></p>
                </div>
                <div class="col">
                    <p class="drop-header"><a href="/admin/catalog/5">Pressure Controls</a></p>
                    <p class="drop-content"><a href="/admin/type/15">Counterbalance Valves</a></p>
                    <p class="drop-content"><a href="/admin/type/14">Relief Valves - Differential Area</a></p>
                    <p class="drop-content"><a href="/admin/type/13">Relief Valves - Direct Acting</a></p>
                </div>
                <div class="col">
                    <p class="drop-header"><a href="/admin/catalog/7">Cartridge Bodies</a></p>
                    <p class="drop-content"><a href="/admin/type/24">2-Way Manifolds</a></p>
                    <p class="drop-content"><a href="/admin/type/22">3-Way Manifolds</a></p>
                    <p class="drop-content"><a href="/admin/type/19">3-Way T-Series Manifolds</a></p>
                    <p class="drop-content"><a href="/admin/type/30">Cavity Plugs</a></p>
                </div>
                <div class="col last-prod-drop">
                    <p class="cms-greyed drop-header">Product Customization</p>
                    <p class="drop-header">Application Information</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Resources Dropdown -->
    <div id="resources-dropdown" class="dropdown">
        <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" href="/admin/manage-resources">Resources</a>
        <div class="dropdown-menu" aria-labelledby="product-dropdown">
            <div class="row no-gutters justify-content-between">
                <p class="drop-header"><a href="/admin/general-information">General Information</a></p>
                <p class="drop-header"><a href="/admin/technical-documentation">Technical Documentation</a></p>
                <p class="drop-header"><a href="/admin/application-information">Application Information</a></p>
                <p class="drop-header"><a href="/admin/model-pricing">Base Product Prices</a></p>
                <p class="cms-greyed drop-header"><a id="download-catalog">Download Our Catalog</a></p>
            </div>
        </div>
    </div><!-- #resources-dropdown end -->

    <a class="cms-greyed nav-link nav-item" disabled>About</a>
    <a class="cms-greyed nav-link nav-item" disabled>Find a Distributor</a>
    <a class="cms-greyed nav-link nav-item" disabled>Contact</a>
    <div id="users-dropdown" class="dropdown">
        <a class="main-nav-hov nav-link nav-item btn dropdown-toggle" href="">Users</a>
        <div class="dropdown-menu" aria-labelledby="users-dropdown">
            <p class="drop-header"><a href="/users/users/add">Add New</a></p>
            <p class="drop-header"><a href="/users/users">View All</a></p>
        </div>
    </div>
    <?= $this->User->logout(); ?>
</nav><!-- main-navbar end -->

<script src="/js/pdfkit.js"></script>
<script src="/js/blob-stream.js"></script>
<script src="/js/catalog.js"></script>
<script>
document.querySelectorAll('#download-catalog').forEach(link => {
    link.onclick = downloadCatalog
})
</script>