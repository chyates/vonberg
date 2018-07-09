<!-- Bringing it back old school -->
<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-three" class="active-title page-title">Edit Product: Series Table</h1>
    <?= $this->Form->create('', ['id' => "edit-prod-three-form"]) ?>
    <div id="three" class="active-slide form-slide">
        <div class="buffer-div">
            <div class="table-create-box p-3">
                <div class="creation-row row no-gutters">
                    <div class="data-column" id="1">
                        <?php echo $this->Form->input('table_header_1-1', 
                        [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'model-header-input form-control',
                            'placeholder' => 'Model',
                            'id' => '1'
                        ]);
                        echo $this->Form->input('table_row_2-1', 
                        [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'model-row-input form-control',
                            'placeholder' => 'Enter model',
                            'id' => '1'
                        ]); ?>
                    </div>
                    <div class="add-column">
                        <a class="model-column add-bullet" href="">Add Column</a>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        <a class="model-row add-bullet" href="">Add Row</a>
                    </div>
                </div>
                <div class="row no-gutters justify-content-between">
                    <a href="/admin/edit-product-two/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
    </div><!-- #three end -->
    <?= $this->Form->end(); ?>
</div><!-- edit-prod-main end -->