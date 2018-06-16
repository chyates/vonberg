<div id="add-cat-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <h1 class="page-title">Add New Category</h1>
                    <?= $this->Form->create('', ['id' => "add-cat-form"]) ?>
                    <?php echo $this->Form->control('name',['cols'=>25, 'rows'=>1,'class'=>'form-control','label'=>'Category Name']);?>
                    <div class="btn-row">
                        <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                        <?= $this->Form->submit('Add',array('id'=>'add-category','class'=>'btn btn-primary','onclick'=>'catAdd();'));?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-type-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <h1 class="page-title">Add New Type</h1>
                    <?= $this->Form->create('', ['id' => "add-cat-form"]) ?>
                    <?php echo $this->Form->control('name',['cols'=>25, 'rows'=>1,'class'=>'form-control','label'=>'Type Name']);?>
                    <div class="btn-row">
                        <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                        <?= $this->Form->submit('Add',array('id'=>'add-type','class'=>'btn btn-primary','onclick'=>'typeAdd();'));?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-series-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <h1 class="page-title">Add New Series</h1>
                    <?= $this->Form->create('', ['id' => "add-cat-form"]) ?>
                    <?php echo $this->Form->control('name',['cols'=>25, 'rows'=>1,'class'=>'form-control','label'=>'Series Name']);?>
                    <div class="btn-row">
                        <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                        <?= $this->Form->submit('Add',array('id'=>'add-series','class'=>'btn btn-primary','onclick'=>'seriesAdd();'));?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-conn-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col">
                    <h1 class="page-title">Add New Short Description</h1>
                    <?= $this->Form->create('', ['id' => "add-cat-form"]) ?>
                    <?php echo $this->Form->control('name',['cols'=>25, 'rows'=>1,'class'=>'form-control','label'=>'Short Description']);?>
                    <div class="btn-row">
                        <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                        <?= $this->Form->submit('Add',array('id'=>'add-connection','class'=>'btn btn-primary','onclick'=>'connAdd();'));?>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cms-add-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- I believe the dropdowns should be populated from the database, ie. the select elements
    for category, type, series, short description, and specifications. -->
    <?= $this->Form->create('', ['id' => "add-prod-form"]) ?>
        <h1 id="title-one" class="active-title page-title">Add New Product</h1>

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
                    <label>Product Status</label>
                    <div class="form-check">
                        <?= $this->Form->checkbox('new_list');?>
                        <label class="form-check-label">New</label>
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
                        'label' => 'Type',
                        'class' => 'form-control'
                    ]);?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input('seriesID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $series,
                        'label' => 'Series',
                        'class' => 'form-control'
                    ]);?>
            </div>
            <div class="form-group">
                <?php
                echo $this->Form->input('connectionID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $conn,
                        'label' => 'Short Description',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <p class="text-right">
            <?= $this->Form->submit('Next',array('class'=>'btn btn-primary','onclick'=>'partAdd();'));?>

            </p>
        </div><!-- #one end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-add-prod-main end -->