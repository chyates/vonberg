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
                        <A HREF="/admin/priceExport">model_prices.csv</A></td>
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

    <div class="table-responsive col-md-8 mx-auto">
        <div id="cms-model-price-table" class="model-table table table-striped">
            <div class="row">
                <div class="col-5 model-table-header">Model</div>
                <div class="col-5 model-table-header">Base Price</div>
                <div class="col-2 model-table-header"></div>
            </div>
            <?php foreach($prices as $price): ?>
                <?= $this->Form->create('edit-model-pricing', 
                    [
                        'id' => "edit-model-pricing", 'class' => 'inactive', 'enctype' => 'multipart/form-data'
                    ]) 
                ?>
                <?php 
                    echo $this->Form->input('id', 
                    [
                        'label'=>False, 
                        'class'=>'hidden form-control', 
                        'type'=>'text', 
                        'value'=> strval($price->model_priceID)
                    ]);
                ?>
                <div class="row no-gutters align-items-center">
                    <div class="col-5 model-table-data">
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
                        ?>
                    </div>
                    <div class="col-5 model-table-data">
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
                                'value'=> $this->Number->currency($price->unit_price, 'USD', array(['places' => 2])),
                            ]);
                        ?>
                    </div>
                    <div class="col-2 model-table-data">
                        <div class="edit">Edit</div>
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </div>
                </div>
                <?= $this->Form->end() ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        Array.prototype.forEach.call(document.querySelectorAll('#cms-model-price-table form'), function(form) {
            form.querySelector('.edit').onclick = function() {
                form.className = 'active'
            }
        })
    </script>

</div><!-- #cms-model-price-main end -->