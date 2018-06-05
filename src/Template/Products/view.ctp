<!-- Get STP Modal -->
<div class="modal fade" id="get-stp-modal" tabindex="-1" role="dialog" aria-labelledby="stp-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img class="modal-close-icon" src="/img/X.svg" />
                    </span>
                </button>
            </div>
            <div class="modal-body col-lg-10 mx-auto">
                <form id="get-stp-form" class="needs-validation" novalidate>
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
                        <div class="invalid-feedback">
                            Please enter your full name.
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="customer-company" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email Address*</label>
                        <input type="text" class="form-control" name="customer-email">
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>

                    <div class="form-group row no-gutters">
                        <div class="col-6 my-auto">
                            <p class="my-auto text-left">*Mandatory</p>
                        </div>
                        <div class="col-6 text-right">
                            <button id="stp-submit" type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                        </div>
                    </div>
                </form>

                <div class="thanks text-center">
                    <h1 class="page-header">Thank you!</h1>
                    <p>You will be receiving an email with the STP files shortly.</p>
                    <button type="button" class="thanks-close btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="single-prod-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5">
    <div id="single-prod-main" class="row mx-lg-5 px-lg-5 py-lg-4">
        <div class="single-prod-left-col flex-column col-sm-7 px-lg-3">
            <div class="left-info">
                <h1 class="page-title"><?= h($part->series->name);?></h1>
                <h3 class="product-name"><?= h($part->category->name);?></h3>
                <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
            </div>

            <div class="left-desc">
                <h3 class="product-name">Description</h3>
                <p class="product-info">
                    <?php echo $part->description; ?>
                </p>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Product Rendering</h3>
                <img class="product-render img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>"/>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Schematic</h3>
                <img  src="<?= "/img/parts/".$part->partID."/hydraulic_symbol.jpg"; ?>"/>
            </div>

            <div class="left-img-div">
                <h3 class="product-name">Typical Performance</h3>
                <img class="product-performance img-fluid" src="<?= "/img/parts/".$part->partID."/typical_performance.jpg"; ?>"/>
            </div>
        </div><!-- .single-prod-left-col end -->

        <div class="single-prod-right-col flex-column col-sm-5 px-lg-0 pt-4">
            <div class="right-top-links">
                <a data-toggle="modal" data-target="#get-stp-modal">Get STP File</a>
                <a href="/products/prices">View Pricing</a>
                <a href="/pdf">Download PDF</a>
            </div>

            <div class="right-main-content p-4">
                <?php
                $typecount='';
                if ($part->text_blocks != Null ) {
                  echo '<div class="right-main-content row p-4">';
                    foreach ($part->text_blocks as $block):
                        if ($typecount <> $block->header) {
                            if ($typecount <> '') {
                                echo '</div>';
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
                    <?php
                    foreach ($part->specifications as $spec): ?>
                        <tr>
                            <td><?php echo $spec->spec_name;?></td>
                            <td><?php echo $spec->spec_value;?></td>
                        </tr>
                    <?php endforeach;?>
                    </table>
                </div>
            </div>

            <div class="right-col-bottom">
                <h3 class="product-name">Ordering Information</h3>

                <img class="product-order img-fluid" src="<?= "/img/parts/".$part->partID."/ordering_information.jpg"; ?>"/>
            </div>

        </div><!-- .single-prod-right-col end -->

    </div><!-- #single-prod-main end -->

    <div class="series-model-table-row row mx-lg-5 px-lg-5">
        <div class="table-responsive">
            <table class="model-table table">

                <thead>
                <?php
                $columns=0;
                foreach ($part->model_table->model_table_headers as $header): ?>
                <th class="model-table-header"><?php echo $header->model_table_text; ?></th>

                <?php
                    $columns++;
                endforeach; ?>
                </thead>

                <tbody>
                <tr>
                    <?php
                    $count=1;
                    $mobCount = 0;
                    foreach ($part->model_table->model_table_rows as $row):
                        echo '<td class="model-table-data">'.$row->model_table_row_text.'</td>';
                        if ($count >= $columns){
                            echo '</tr><tr>';
                            $count=0;
                        }
                        $count++;
                        $mobCount++;
                    endforeach;
                    ?>
                </tr>
                </tbody>
            </table>
        </div>

    </div><!-- .series-model-table end -->

    <!-- Mobile model table/dropdowns -->
    <div id="mob-model-tables" class="col-12">
        <div class="row no-gutters">
            <div class="col-3">
            <?php $mobHead = 1;
            for($i = 0; $i <= ($mobCount/$columns)-1; $i++) {
                foreach ($part->model_table->model_table_headers as $header):
                    if($mobHead === 2) {
                        echo '<div class="mob-hidden">';
                    }
                ?>
                    <p class="model-table-header"><?php echo $header->model_table_text; ?></p>
                <?php if ($mobHead >= $columns){
                    echo '</p><p></div>';
                    $mobHead=0;
                }
                $mobHead++;
                endforeach; 
                } ?>
            </div>
            <div class="col-9">
            <?php $mobRow = 1;
            foreach ($part->model_table->model_table_rows as $row):
                if($mobRow === 2) {
                    echo '<div class="mob-hidden">';
                } if ($mobRow === 1) {
                    echo '<p class="model-table-data">'.$row->model_table_row_text.'<a class="drop-toggle" href="">View More</a></p>';
                } else {
                    echo '<p class="model-table-data">'.$row->model_table_row_text.'</p>';
                }
                if ($mobRow >= $columns){
                    echo '</p><p></div>';
                    $mobRow=0;
                }
                $count++;
                $mobRow++;
            endforeach;
            ?>
            </div>
        </div>
    </div>

    <div class="legalese row mx-sm-5 px-sm-5 px-3 pb-sm-5 pb-3">
        <p class="legal-title mx-auto mb-1">Page last updated: <?php echo $part->last_updated;?></p>
        <p class="legal-block">This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met.</p>
        <p class="legal-block">The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of vonberg valve, inc. without prior notification.</p>
    </div> <!-- .legalese end -->
</div><!-- #single-prod-main-container end -->

<script type="text/javascript">
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                console.log("Hit form validation function");
                if (form.checkValidity() === false) {
                    console.log("Form is invalid, check");
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
  })();

    $(document).ready(function(){
        $("#get-stp-form").submit(function(e){
            e.preventDefault();
            $(this).hide();
            $(".thanks").show();
        });

        $("a.drop-toggle").click(function(e) {
            e.preventDefault();
            $(this).closest("p.model-table-data").next(".mob-hidden").show();
            $(this).closest(".col-9").prev(".col-3").find("p.model-table-header").next(".mob-hidden").show();
        })
    })
</script>