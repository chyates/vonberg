<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>

<div id="home-container" class="col-10 mx-auto">
    <div id="hero-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid" src="/img/Homepage-hero-1@2x-min.png" alt="hero1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Innovative solutions for your hydraulic needs</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/Homepage-hero-2@2x-min.png" alt="hero2"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Innovative solutions for your hydraulic needs</h5>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/Homepage-hero-3@2x-min.png" alt="hero3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Innovative solutions for your hydraulic needs</h5>
                </div>
            </div>

        </div>
    </div><!-- hero carousel end -->

    <div id="homepage-cards" class="d-flex flex-row my-4">
        <div class="homepage-single-card card flex-column">
            <img class="card-img-top" src="/img/Products-homepage.png">
            <div class="card-body">
                <p class="card-text">At Vonberg, we’re proud to design, manufacture, assemble and test a unique product line of in-line and cartridge style valves in our state-of-the-art facility.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products">See Products</a></button>
            </div>
        </div>

        <div class="homepage-single-card card flex-column">
            <img class="card-img-top" src="/img/Manifold-homepage.png">
            <div class="card-body">
                <p class="card-text">We design and manufacture integrated manifolds using our own cartridge products as well as standard market cartridge valves, and a full line of cartridge cavity plugs.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products">See Cartridge Bodies</a></button>
            </div>
        </div>

        <div class="homepage-single-card card flex-column">
            <img class="card-img-top" src="/img/Learn-more-homepage.png">
            <div class="card-body">
                <p class="card-text">If you don’t find what you need in the online catalog, we are able to modify existing products or design new products to meet your application requirements.</p>
                <button type="button" class="btn btn-primary home-card-button"><a href="/products">Learn More</a></button>
            </div>
        </div>
    </div><!-- homepage-cards end -->

    <div id="home-lower-logos" class="text-center my-4">
        <p>Hydraulic Innovation since 1971</p>
        <img class="d-block mx-auto my-3 img-fluid" src="/img/1971-logo.png">

        <div class="my-4 justify-content-center">
            <img class="img-fluid" src="/img/nfpa-logo.png">
            <img class="img-fluid" src="/img/IFPS-logo.png">
            <img class="img-fluid" src="/img/NAM-logo.png">
            <img class="img-fluid" src="/img/madeusa2.png">
            <img class="img-fluid" src="/img/mastercardvisa.png">
        </div>

        <p class="home-lower-cert">ISO 9001:2008 CERTIFIED</p>
    </div><!-- home-lower-logos end -->
</div><!-- home-container end -->
