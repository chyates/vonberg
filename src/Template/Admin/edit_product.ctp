<div id="add-cat-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-cat-modal-label" aria-hidden="true">
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
                <h1 class="page-title">Add New Category</h1>
                <?= $this->Form->create('', ['id' => "add-cat-form", 'class' => 'my-4']) ?>
                <?php echo $this->Form->text('cat',['class'=>'form-control','label'=>'Category Name','id' => "cat", 'placeholder' => 'Enter new category name']);?>
                <div class="row no-gutters justify-content-between my-4">
                    <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                    <?= $this->Form->submit('Add',array('id'=>'add-category','class'=>'btn btn-primary','onclick'=>'catAdd();'));?>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- add cat modal end -->

<div id="add-type-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-type-modal-label" aria-hidden="true">
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
                <h1 class="page-title">Add New Type</h1>
                <?= $this->Form->create('', ['id' => "add-cat-form", 'class' => 'my-4']) ?>
                <?php echo $this->Form->text('type',['class'=>'form-control','label'=>'Type Name','id' => "type", 'placeholder' => 'Enter new type name']);?>
                <div class="row no-gutters justify-content-between my-4">
                    <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                    <?= $this->Form->submit('Add',array('id'=>'add-type','class'=>'btn btn-primary','onclick'=>'typeAdd();'));?>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- add type modal end -->

<div id="add-series-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-series-modal-label" aria-hidden="true">
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
                <h1 class="page-title">Add New Series</h1>
                <?= $this->Form->create('', ['id' => "add-cat-form", 'class' => 'my-4']) ?>
                <?php echo $this->Form->text('series',['class'=>'form-control','label'=>'Series Name','id' => "series", 'placeholder' => 'Enter new series name']);?>
                <div class="row no-gutters justify-content-between my-4">
                    <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                    <?= $this->Form->submit('Add',array('id'=>'add-series','class'=>'btn btn-primary','onclick'=>'seriesAdd();'));?>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- add series modal end -->

<div id="add-conn-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-conn-modal-label" aria-hidden="true">
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
                <h1 class="page-title">Add New Short Description</h1>
                <?= $this->Form->create('', ['id' => "add-cat-form", 'class' => 'my-4']) ?>
                <?php echo $this->Form->text('conn',['class'=>'form-control','label'=>'Short Description','id' => "conn", 'placeholder' => 'Enter new short description']);?>
                <div class="row no-gutters justify-content-between my-4">
                    <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                    <?= $this->Form->submit('Add',array('id'=>'add-connection','class'=>'btn btn-primary','onclick'=>'connAdd()'));?>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- add conn modal end -->

<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-one" class="active-title page-title">Edit Product</h1>
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>

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
                <label>Expiration (days)</label>
                    <?= $this->Form->input('expires',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => [
                            ['text' => '30', 'value' => 30],
                            ['text' => '60', 'value' => 60],
                            ['text' => '90', 'value' => 90]
                        ],
                        'label' => false,
                        'class' => 'form-control'
                    ]
                    );?>
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
            <div class="form-group">
                <?php
                echo $this->Form->input('connectionID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $conn,
                        'id'=> 'connectionid',
                        'label' => 'Short Description',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <p class="text-right"><?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>

            </p>
        </div><!-- #one end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->