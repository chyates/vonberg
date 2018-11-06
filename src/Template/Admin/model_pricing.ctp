<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div id="cms-model-price-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Model Pricing</h1>

    <div class="table-responsive justify-content-between rsrc-table col-md-8 mx-auto">
        <h2 class="category-title">CSV File</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/download.svg"/>
                        </span>
                        <?php
                            echo $this->Html->link(
                                'model_prices.csv',
                                '/admin/priceExport'
                            );
                        ?>
                    </td>
                    <td class="d-flex justify-content-between">
                        <?= $this->Form->create('priceImport',['type' => 'file','url' => ['controller'=>'admin','action' => 'priceImport'],'class'=>'form-inline','role'=>'form',]) ?>
                        <div class="form-group">
                            <label class="sr-only" for="csv"> CSV </label>
                            <label class="fileContainer">Browse
                                <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false]); ?>
                            </label>
                        </div>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <?= $this->Form->end() ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="row no-gutters justify-content-center">
        <div class="table-responsive col-md-6">
            <h3 class="product-name">Modify Prices</h3>
            <div id="cms-model-price-table" class="model-table table table-striped">
                <div class="row no-gutters">
                    <div class="col-4 model-table-header">Model</div>
                    <div class="col-6 model-table-header">Base Price</div>
                    <div class="col-2 model-table-header"></div>
                </div>
                <?php foreach($prices as $price): ?>
                    <?= $this->Form->create('edit-model-pricing', 
                        [
                            'id' => "edit-model-pricing",
                            'class' => 'inactive', 
                            'enctype' => 'multipart/form-data',
                            'url' => ['controller' => 'Admin', 'action' => 'modelPricing']
                        ]) 
                    ?>
                    <?php 
                        if(!empty($price->model_priceID)) {

                            echo $this->Form->input('id', 
                            [
                                'label'=>False, 
                                'class'=>'hidden form-control', 
                                'type'=>'text', 
                                'value'=> strval($price->model_priceID)
                            ]);
                        } else {
                            echo "N/A";
                        }
                    ?>
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 model-table-data">
                            <?php if(!empty($price->model_text)) { ?>
                                <div>
                                    <?php 
                                        echo $price->model_text; 
                                    ?>
                                </div>
                                <?php 
                                    echo $this->Form->input('model_text', 
                                    [
                                        'label'=>False, 
                                        'type'=>'text',
                                        'class' => 'form-control',
                                        'value'=>$price->model_text
                                    ]);
                                } else {
                                    echo "N/A";
                                }
                           ?>
                        </div>
                        <div class="col-6 model-table-data">
                            <?php if(!empty($price->unit_price)) { ?>
                                <div>
                                    <?php 
                                        echo $this->Number->currency($price->unit_price, 'USD', array(['places' => 2])); 
                                    ?>
                                </div>
                                <span>$</span>
                                <?php 
                                    echo $this->Form->input('unit_price', 
                                    [
                                        'label'=>False, 
                                        'type'=>'text',
                                        'class' => 'form-control', 
                                        'value'=> $this->Number->precision($price->unit_price, 2),
                                    ]);
                                } else {
                                    echo "N/A";
                                }
                            ?>
                            <div class="cancel">Cancel</div>
                        </div>
                        <div class="col-2 model-table-data">
                            <div class="edit">Edit</div>
                            <input type="submit" class="btn btn-primary" value="Save" />
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                <?php endforeach; ?>
            </div>

        </div><!-- pricing table end -->

        <div class="col-md-3 mx-3">
            <h3 class="product-name">Add Prices</h3>
            <?= $this->Form->create('add-price-form',
                [
                    'id' => 'add-price-form',
                    'url' => ['controller' => 'Admin', 'action' => 'addPrice'],
                    'class' => 'mt-3 needs-validation',
                    'novalidate'
                ]);
            ?>

            <div class="form-group">
                <?php 
                    echo $this->Form->input('add_text',
                    [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => 'Model Number',
                        'required'
                    ]);
                ?>
            </div>

            <div class="form-group">
                <?php 
                    echo $this->Form->control('description', 
                    [
                        'label' => 'Description', 
                        'type' => 'textarea', 
                        'class' => 'form-control'
                    ]); 
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo $this->Form->input('add_price',
                    [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => 'Base Price',
                        'required'
                    ]);
                ?>
            </div>
            
            <div class="text-right">
                <?= $this->Form->submit('Add New Price', array('class'=>'btn btn-primary')); ?>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>

    <div class="row no-gutters">
        
    </div>

    <script>
        Array.prototype.forEach.call(document.querySelectorAll('#cms-model-price-table form'), function(form) {
            form.querySelector('.edit').onclick = function() {
                form.className = 'active'
            }
            form.querySelector('.cancel').onclick = function() {
                form.className = 'inactive'
            }
        });

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
                        event.preventDefault();
                        event.stopPropagation();
                        console.log("Form is invalid, check");
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    jQuery(document).ready(function($) {
        var feedback = '<div class="invalid-feedback">This field is required.</div>'
        $("#add-price-form textarea").after(feedback)
        $("#add-price-form input").each(function(index) {
            $(this).after(feedback)
        })
    })
    </script>

</div><!-- #cms-model-price-main end -->