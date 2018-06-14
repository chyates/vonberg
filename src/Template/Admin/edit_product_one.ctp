<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-one" class="active-title page-title">Edit Product</h1>

        <div id="one" class="active-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <?php echo $this->Form->input('categoryID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $cat,
                        'label' => 'Category',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <div class="row no-gutters">
                <div class="col-sm-6">
                    <label>New Product Status</label>
                    <div class="form-check">
                        <?= $this->Form->checkbox('new_list');?>
                        <label class="form-check-label">Yes</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Expiration</label>
                    <select class="form-control" name="product-expiration">
                        <option value="Select..." selected disabled>Select...</option>
                    </select>
                </div>
            </div>

            <label>Style</label>
            <div class="form-group">
                <?php echo $this->Form->control('styleID',
                    [
                        'templates'  =>[ 'inputContainer' => '<div class="input form-check form-check-inline {{type}}{{required}}">{{content}}</div>'],
                        'type' => 'radio',
                        'multiple' => false,
                        'options' => $style,
                        'label' => False,
                        'class' => 'form-check-input'
                    ]);?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('typeID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $type,
                        'label' => 'Series',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('seriesID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $series,
                        'label' => 'Series',
                        'class' => 'form-control'
                    ]);?>

            </div>


            <p class="text-right">          <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>

            </p>
        </div><!-- #one end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->