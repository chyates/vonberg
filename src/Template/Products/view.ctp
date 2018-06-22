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
                <h1 class="page-header">Get STP Files</h1>
                    <?php echo $this->Form->create('get-stp-form', array(
                        'id' => 'get-stp-form',
                        'class' => 'needs-validation',
                        'novalidate',
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false

                        )
                    )); ?>
                    <p>You will receive an email with the files attached.</p>
                    <p>Which model(s) are you interested in?*</p>
                    <?php $mobRow = 1;
                    $rowID = 1;
                    $width = sizeof($part->model_table->model_table_headers); ?>
                    <div id="check-container">
                        <?php foreach ($part->model_table->model_table_rows as $row):
                         if ($mobRow === 1) {
                             echo '<div class="form-check check-req">';
                             echo $this->Form->control('model', ['type' => 'checkbox', 'value'=> $row->model_table_rowID, 'class' => 'form-check-input', 'label' => ['text' => 'Model ' . $row->model_table_row_text, 'class' => 'form-check-label'], 'id' => $row->model_table_rowID]);
                             echo '</div>';
                            }
                            if ($mobRow >= $width){
                                $mobRow=0;
                            }
                            $mobRow++;
                        endforeach;
                        ?>
                    </div>
                    <p id="check-validity" class="invalid-feedback" style="display: none;">
                        Please select at least one model file.
                    </p>
                    <p>Don’t see the model you’re looking for?<a href="/contact" class="px-2">Contact us!</a></p>

                        <?php echo $this->Form->control('first_name', ['label' => 'First Name*', 'type' => 'text', 'class' => 'form-control', 'required']); ?>

                        <?php echo $this->Form->control('last_name', ['label' => 'Last Name*', 'type' => 'text', 'class' => 'form-control', 'required']); ?>

                       <?php echo $this->Form->control('company', ['type' => 'text', 'class' => 'form-control']);?>


                        <?php echo $this->Form->control('email', ['label' => 'Email*', 'type' => 'text', 'class' => 'form-control', 'required']);?>


                    <div class="form-group row no-gutters">
                        <div class="col-6 my-auto">
                            <p class="my-auto req-text text-left">*Mandatory</p>
                        </div>
                        <div class="col-6 text-right">
                        <?php
                        echo $this->Form->submit('SUBMIT',array(
                            'id' => 'stp-submit',
                            'class' => 'btn btn-primary'));
                        ?>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->end();?>

                <div class="thanks text-center">
                    <h1 class="page-header">Thank you!</h1>
                    <div class="modal_message"></div>
                    <p>You will be receiving an email with the STP files shortly.</p>
                    <button type="button" class="thanks-close btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="single-prod-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5">
    <div id="single-prod-main" class="row no-gutters mx-lg-5 px-lg-5 py-lg-4">
        <?php 
            $curr_url = $this->request->here;
            $seg = '';
            for($q = 0; $q < strlen($curr_url); $q++) {
                if($curr_url[$q] === 'w') {
                    for($x = $q + 2; $x < strlen($curr_url); $x++) {
                        $seg .= $curr_url[$x];
                    }
                }
            }
            // echo $seg;
        ?>
        <div class="single-prod-left-col col-sm-7 col-12 px-lg-3">
            <div class="left-info">
                <h1 class="page-title"><?= h($part->series->name);?></h1>
                <h3 class="product-name"><?= h($part->category->name);?></h3>
                <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
            </div>

            <div class="left-desc mt-sm-3">
                <h3 class="product-name">Description</h3>
                <p class="product-info">
                    <?php echo $part->description; ?>
                </p>
            </div>

            <?php if (file_exists('img/parts/'.$part->partID.'/schematic_drawing.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Product Rendering</h3>
                <img class="my-3 img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>"/>
            </div>
            <?php } ?>

            <?php if (file_exists('img/parts/'.$part->partID.'/hydraulic_symbol.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Schematic</h3>
                <img class="my-3 " src="<?= "/img/parts/".$part->partID."/hydraulic_symbol.jpg"; ?>"/>
            </div>
            <?php } ?>

            <?php if (file_exists('img/parts/'.$part->partID.'/typical_performance.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Typical Performance</h3>
                <img class="my-3 product-performance img-fluid" src="<?= "/img/parts/".$part->partID."/typical_performance.jpg"; ?>" />
            </div>
            <?php } ?>

        </div><!-- .single-prod-left-col end -->

        <div class="single-prod-right-col col-sm-5 col-12 px-lg-0 pt-4">
            <div class="right-top-links">
                <a data-toggle="modal" data-target="#get-stp-modal">Get STP File</a>
                <a href="/products/prices?q=&seriesID=<?php echo $part->seriesID; ?>">View Pricing</a>
                <a href=<?= "/img/pdfs/catalog/" . $part->partID . ".pdf"; ?> target="_blank" >Download PDF</a>
            </div>

            <div class="right-main-content mt-sm-3 p-sm-4">
                <?php
                $typecount='';
                if ($part->text_blocks != Null ) {
                  echo '<div class="row no-gutters">';
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
                            <th><?php echo $spec->spec_name;?></th>
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

    <div class="series-model-table-row row no-gutters mx-lg-5 px-lg-5">
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
                            echo '</tr>';
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
        <div class="row no-gutters pt-4 pb-3">
            <div class="col-4">
            <?php $mobHead = 1;
            $divID = 1;
            for($i = 0; $i <= ($mobCount/$columns)-1; $i++) {
                foreach ($part->model_table->model_table_headers as $header):
                    if($mobHead === 2) {
                        echo '<div class="mob-hidden ' . strval($divID) . '">';
                    } if($mobHead === 1) { ?>
                    <p class="top-data model-table-header"><?php echo $header->model_table_text; ?></p>

                <?php } else { ?>
                    <p class="model-table-header"><?php echo $header->model_table_text; ?></p>
                <?php } if ($mobHead >= $columns){
                    echo '</div>';
                    $mobHead=0;
                }
                $mobHead++;
            endforeach; 
            $divID++;
                } 
            ?>
            </div>
            <div class="col-8">
            <?php $mobRow = 1;
            $rowID = 1;
            foreach ($part->model_table->model_table_rows as $row):
                if($mobRow === 2) {
                    echo '<div class="mob-hidden ' . $rowID . '">';
                    $rowID++;
                } if ($mobRow === 1) {
                    echo '<p class="top-data model-table-data">'.$row->model_table_row_text.'<a class="drop-toggle" href="">View More</a><span class=""><img class="mob-arrow img-fluid" src="/img/Arrow-Down.svg"/></span></p>';
                } else {
                    echo '<p class="model-table-data">'.$row->model_table_row_text.'</p>';
                }
                if ($mobRow >= $columns){
                    echo '</div>';
                    $mobRow=0;
                }
                $count++;
                $mobRow++;
            endforeach;
            ?>
            </div>
        </div>
    </div>

    <div id="mob-bottom-links" class="row no-gutters">
        <div class="col text-center">
            <button class="btn btn-primary" data-toggle="modal" data-target="#get-stp-modal">Get STP File</button>
            <a class="btn btn-primary" href=<?= "/img/pdfs/catalog/" . $part->partID . ".pdf"; ?> download >Download PDF</a>
            <a class="center-link" href="/products/prices">View Pricing</a>
        </div>
    </div>

    <div class="legalese row no-gutters mx-sm-5 px-sm-5 ;px-3 pb-sm-5 pb-3">
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
        var checkboxes = document.querySelectorAll('.check-req');
        var checkStatus = [];
        var showDiv = document.getElementById('check-validity');
        
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                console.log("Hit form validation function");
                if (form.checkValidity() === false) {
                    console.log("Form is invalid, check");
                    // loop through checkboxes to find if any have been selected
                    for(var i = 0; i < checkboxes.length; i++) {
                        var divs = checkboxes[i].children;
                        for(var j = 0; j < divs.length; j++) {
                            var labels = divs[j].children;
                            for(var k = 0; k < labels.length; k++) {
                                var inputs = labels[k].children;
                                for(var m = 0; m < inputs.length; m++) {
                                    if(inputs[m].checked) {
                                        checkStatus.push(inputs[m].checked);
                                    }
                                }
                            }

                        }
                    }
                    if (checkStatus.length < 1) {
                        showDiv.style.display = 'block';
                    }
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
  })();

    $(document).ready(function(){
        var feedback = '<p class="invalid-feedback">This field is required.</p>';
        $("input:not(input[type=hidden])").each(function(index) {
            $(this).after(feedback)
        });
        $("#get-stp-form .input").not("#get-stp-form .input.checkbox").addClass('form-group');
        $("#get-stp-form").submit(function(e){
            e.preventDefault();
            var myform = $("#get-stp-form");
            var fd = myform.serializeArray();
            $.ajax({
                type: 'POST',
                encoding:"UTF-8",
                url:'/contact/stp/',
                data: fd,
                cache: false,
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert(xhr.responseText);
                    alert("Error: "+thrownError);
                },
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    return xhr;
                },
                beforeSend: function () {
                    //do sth
                  //  xhr.setRequestHeader('X-CSRF-Token', <?= json_encode($this->request->param('_csrfToken')); ?>);
                },
                complete: function () {
                    //do sth
                },
                success: function (response) {
                    // console.log("Model information");
                    $(".modal_message").html(data);
                }
            });
            $(this).hide();
            $(".thanks").show();
        });

        $("a.drop-toggle").click(function(e) {
            e.preventDefault();
            var eachClass = $(this).closest("p.model-table-data").next(".mob-hidden").attr("class");
            var res = eachClass.replace(' ', '.');
            var leftDiv = $(this).closest(".col-8").prev(".col-4").find("div").filter('.' + res);
            if(leftDiv.css('display') == "none") {
                $(this).closest("p.model-table-data").next('.mob-hidden').show();
                leftDiv.show();
                $(this).text("View Less");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Up.svg');
            } else {
                $(this).closest("p.model-table-data").next('.mob-hidden').hide();
                leftDiv.hide();
                $(this).text("View More");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Down.svg');
            }
        })
    })
</script>