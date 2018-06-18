<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>

<div id="home-container" class="inner-main col-lg-10 col-md-12 mx-lg-auto"> 
    <div class="slider-container row no-gutters">
        <div id="hero-slider" class="col">
            <h5 class="slider-title">Innovative<br>solutions for<br>your hydraulic<br>valve needs</h5>
        </div>
    </div>

    <div id="homepage-cards" class="my-4">
        <div class="homepage-single-card card flex-column my-sm-0 my-3">
            <img class="card-img-top" src="/img/Products-homepage.png">
            <div class="card-body">
                <p class="card-text">At Vonberg, we’re proud to design, manufacture, assemble and test a unique product line of in-line and cartridge style valves in our state-of-the-art facility.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products">See Products</a></button>
            </div>
        </div>

        <div class="homepage-single-card card flex-column my-sm-0 my-3">
            <img class="card-img-top" src="/img/Manifold-homepage.png">
            <div class="card-body">
                <p class="card-text">We design and manufacture integrated manifolds using our own cartridge products as well as standard market cartridge valves, and a full line of cartridge cavity plugs.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products/catalog/7">See Cartridge Bodies</a></button>
            </div>
        </div>

        <div class="homepage-single-card card flex-column my-sm-0 my-3">
            <img class="card-img-top" src="/img/Learn-more-homepage.png">
            <div class="card-body">
                <p class="card-text">If you don’t find what you need in the online catalog, we are able to modify existing products or design new products to meet your application requirements.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products/customization">Learn More</a></button>
            </div>
        </div>
    </div><!-- homepage-cards end -->

    <div id="home-lower-logos" class="text-center my-md-4">
        <p><a href="/about">Hydraulic Innovation since 1971</a></p>
        <a href="/about"><img class="d-block mx-auto my-3 img-fluid" src="/img/1971-logo.png"></a>

        <div class="my-4 justify-content-center">
            <a href="http://www.nfpa.com/" target="_blank"><img class="img-fluid" src="/img/nfpa-logo.png"></a>
            <a href="http://www.ifps.org/" target="_blank"><img class="img-fluid" src="/img/IFPS-logo.png"></a>
            <a href="http://www.nam.org/" target="_blank"><img class="img-fluid" src="/img/NAM-logo.png"></a>
            <img class="img-fluid" src="/img/madeusa2.png">
            <img class="img-fluid" src="/img/mastercardvisa.png">
        </div>

        <p class="home-lower-cert">ISO 9001:2008 CERTIFIED</p>
    </div><!-- home-lower-logos end -->
</div><!-- home-container end -->
