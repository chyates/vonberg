<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>

<div id="resources-main-container" class="col-10 mx-auto p-5">
    <h1 class="page-title">Resources</h1>
    <div class="row no-gutters my-4">
        <div class="col-lg-9 mx-auto">
            <div class="row no-gutters justify-content-center">
                <div class="resource-block col-lg-5 p-4 mx-3 mb-3">
                    <h2>General Information</h2>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 1</a></p>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 2 with even longer title that wraps around to second line</a></p>
                    <a class="btn my-4" href="/general-information">View All</a>
                </div>
                <div class="resource-block col-lg-5 p-4 mx-3 mb-3">
                    <h2>Technical Documentation</h2>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 1</a></p>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 2 with even longer title that wraps around to second line</a></p>
                    <a class="btn my-4" href="/general-information">View All</a>
                </div>
            </div>
            <div class="row no-gutters justify-content-center">
                <div class="resource-block col-lg-5 p-4 mx-3 mb-3">
                    <h2>Application Information</h2>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 1</a></p>
                    <p class="resource-link"><span class="pr-3"><i class="far fa-file-pdf"></i></span><a href="/pdf">Downloadable PDF 2 with even longer title that wraps around to second line</a></p>
                    <a class="btn my-4" href="/general-information">View All</a>
                </div>
                <div class="resource-block col-lg-5 p-4 mx-3 mb-3">
                    <h2>Base Product Prices</h2>
                    <label>Enter Model Number</label>
                    <input type="text" class="form-control" name="product-model">
                    <p class="text-center">or</p>
                    <label>Select a Series</label>
                    <select class="form-control" name="product-series">
                        <option value="--">--</option>
                    </select>
                    <a class="btn my-4" href="/general-information">Get Prices</a>
                </div>
                <button type="button" class="btn download-btn btn-primary my-4">Download Product Catalogue</button>
            </div>
        </div>
    </div>
</div><!-- #resources-main-end -->