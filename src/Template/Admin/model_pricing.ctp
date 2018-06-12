<div id="cms-model-price-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Model Pricing</h1>
    <div class="table-responsive justify-content-between rsrc-table col-md-8 mx-auto">
        <h2 class="category-title">CSV File</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Last Updated</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><A HREF="/admin/priceExport">FileName.pdf</A></td>
                    <td>2017-11-08 13:46:02</td>
                    <td class="justify-content-between">
                        <?= $this->Form->create('priceImport',['type' => 'file','url' => ['controller'=>'admin','action' => 'priceImport'],'class'=>'form-inline','role'=>'form',]) ?>
                        <div class="form-group">
                            <label class="sr-only" for="csv"> CSV </label>
                            <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false, 'placeholder' => 'csv upload',]); ?>
                        </div>
                        <button type="submit" class="btn btn-default"> Upload </button>
                        <?= $this->Form->end() ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive col-md-8 mx-auto">
        <table id="cms-model-price-table" class="model-table table table-striped">
            <thead>
                <tr>
                    <th class="model-table-header">Model</th>
                    <th class="model-table-header">Base Price</th>
                    <th class="model-table-header"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($prices as $price): ?>
                <tr>
                    <td class="model-table-data"><?php echo $price->model_text; ?></td>
                    <td class="model-table-data"><?php echo money_format('$%.2n', $price->unit_price); ?></td>
                    <td class="model-table-data"><a href="/admin/edit-product">Edit</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div><!-- #cms-model-price-main end -->