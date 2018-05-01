<!-- Get STP Modal -->
<div class="modal fade" id="get-stp-modal" tabindex="-1" role="dialog" aria-labelledby="stp-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-lg-10 mx-auto">
                <form id="get-stp-form" class="">
                    <h1 class="page-header">Get STP Files</h1>
                    <p>You will receive an email with the files attached.</p>
                    <p>Which model(s) are you interested in?*</p>

                    <div class="form-check text-center">
                        <input type="checkbox" class="form-check-input" name="model" value="model1">
                        <label class="form-check-label">Model 1</label>
                    </div>
                    <div class="form-check text-center">
                        <input type="checkbox" class="form-check-input" name="model" value="model2">
                        <label class="form-check-label">Model 2</label>
                    </div>
                    <div class="form-check text-center">
                        <input type="checkbox" class="form-check-input" name="model" value="model3">
                        <label class="form-check-label">Model 3</label>
                    </div>

                    <p>Don’t see the model you’re looking for?<a href="/contact" class="px-2">Contact us!</a></p>

                    <div class="form-group">
                        <label>Full Name*</label>
                        <input type="text" name="customer-name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="customer-company" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email Address*</label>
                        <input type="text" class="form-control" name="customer-email">
                    </div>

                    <div class="form-group row no-gutters">
                        <div class="col-6 my-auto">
                            <p class="my-auto text-left">*Mandatory</p>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="stp-thanks-modal" tabindex="-1" role="dialog" aria-labelledby="stp-thanks-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-lg-10 mx-auto text-center">
                <h1 class="page-header">Thank you!</h1>
                <p>You will be receiving an email with the STP files shortly.</p>
                <button type="button" class="thanks-close btn btn-primary">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="single-prod-main-container" class="col-10 mx-auto">

    <div id="single-prod-main" class="row mx-5 px-5">
        <div class="single-prod-left-col col-lg-8 px-3 py-5">
            <div class="left-info">
                <h1 class="page-title"><?= h($part->series->name);?></h1>
                <h3 class="product-name"><?= h($part->category->name);?></h3>
                <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
            </div>

            <div class="left-desc">
                <h3 class="product-name">Description</h3>
                <p class="product-info">
                    <?= fread($part->description,256) ?>
                </p>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Product Rendering</h3>
                <img class="product-render img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png"/>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Schematic</h3>
                <img class="product-schematic img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png"/>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Typical Performance</h3>
                <img class="product-performance img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png"/>
            </div>
        </div><!-- .single-prod-left-col end -->

        <div class="single-prod-right-col col-lg-4 px-0 py-5">
            <div class="right-top-links row mb-2 justify-content-between">
                <a data-toggle="modal" data-target="#get-stp-modal">Get STP File</a>
                <a data-toggle="modal" data-target="#stp-thanks-modal">View Pricing</a>
                <a href="/pdf">Download PDF</a>
            </div>
            <div class="right-main-content row p-4">
                <?php
                $typecount='';
                if ($part->text_blocks != Null ) {
                  echo '<ul class="right-main-content row p-4">';
                    foreach ($part->text_blocks as $block):
                        if ($typecount <> $block->header) {
                            if ($typecount <> '') {
                                echo '</ul>';
                            }
                            echo '<h3 class="product-name">';
                            echo $block->header;
                            echo '</h3>
                        <ul class="right-list px-3">';
                        }
                        foreach ($block->text_block_bullets as $bullet):
                            echo '<li class="mt-2 pl-3">' . $bullet->bullet_text . '</li>';
                        endforeach; ?>
                        <?php
                        $typecount = $block->header;
                    endforeach;
                    echo '</ul>';
                }?>

                <h3 class="product-name">Specifications</h3>

                <div class="spec-table table-sm">
                    <table class="table">
                        <tr>
                            <td>Pressure Range</td>
                            <td>250 PSI TO 4500 PSI</td>
                        </tr>
                        <tr>
                            <td>TEMPERATURE RANGE</td>
                            <td>250°F TO -40°F</td>
                        </tr>
                        <tr>
                            <td>Flow Tolerance</td>
                            <td>+/- 10%</td>
                        </tr>
                        <tr>
                            <td>MAX. PRESSURE DIFFERENTIAL "1" TO "2"</td>
                            <td>100 PSI</td>
                        </tr>
                        <tr>
                            <td>DIVIDE / COMBINE RATIO</td>
                            <td>50:50</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="right-col-bottom row">
                <h3 class="product-name">Ordering Information</h3>

                <img class="product-order img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png"/>
            </div>

        </div><!-- .single-prod-right-col end -->

    </div><!-- #single-prod-main end -->

    <div class="series-model-table-row row mx-5 px-5">
        <div class="table-responsive">
            <table class="model-table table">
                <thead>
                <th class="model-table-header">Model</th>
                <th class="model-table-header">Inlet/Outlet</th>
                <th class="model-table-header">Flow Range</th>
                <th class="model-table-header">L</th>
                <th class="model-table-header">Hex</th>
                </thead>

                <tbody>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div><!-- .series-model-table end -->

    <div class="legalese row mx-5 px-5 pb-5">
        <p class="legal-title mx-auto mb-1">Page last updated: November 08, 2017</p>
        <p class="legal-block">This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met.</p>
        <p class="legal-block">The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of vonberg valve, inc. without prior notification.</p>
    </div> <!-- .legalese end -->
