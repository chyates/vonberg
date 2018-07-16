<div id="cms-add-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Add Resource</h1>
    
    <div class="col-6 mx-auto">

        <?= $this->Form->create('add-rsrc-form', array('url' => array('action' => 'add-resource'),'enctype' => 'multipart/form-data', 'id' => 'add-rsrc-form'));
        ?>
        <div class="form-group">
            <label>Select Page</label>
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
            <?php echo $this->Form->input('title', ['label' => ['text' => 'File Title'], 'class'=>'form-control']); ?>
        </div>

        <div class="form-group">
            <label id="up-label-addrsrc">Upload File</label>
            <label class="fileContainer">Browse
                <?php 
                    echo $this->Form->input('file', ['type' => 'file', 'class'=>'form-control', 'label' => false]);
                    echo $this->Form->input('file_path', ['type' => 'hidden']); 
                ?>
            </label>
            <p class="file-text">No file chosen</p>
        </div>
<?php
        echo $this->Form->submit('Add Resource', ['class' => 'btn btn-primary', 'id' => 'add-rsrc-submit']);
        echo $this->Form->end();?>

    </div>
</div><!-- #cms-manage-resources-main end -->