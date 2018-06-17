<div id="cms-add-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Add Resource</h1>
    
    <div class="col-6 mx-auto">

        <?= $this->Form->create('add-rsrc-form', array('url' => array('action' => 'add-resource'),'enctype' => 'multipart/form-data'));
        ?>
        <div class="form-group">
            <?=  $this->Form->select(
            'resource',
            [
            ['value' => '2', 'text' => 'General Information'],
            ['value' => '1', 'text' => 'Technical Documentation'],
            ['value' => '3', 'text' => 'Application Information'],
            ],['class'=>'form-control']
            );?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input('title', ['class'=>'form-control']);?>
        </div>

        <div class="form-group">
            <label id="up-label-addrsrc">Upload File</label>
            <label class="fileContainer">Browse
                <?php echo $this->Form->input('file', ['type' => 'file', 'class'=>'form-control']);?>
            </label>
        </div>
<?php
        echo $this->Form->button('Upload CSV File', ['class' => 'form-control btn btn-lg btn-success1 btn-block padding-t-b-15']);
        echo $this->Form->end();?>

    </div>
</div><!-- #cms-manage-resources-main end -->