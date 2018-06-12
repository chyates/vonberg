<div id="cms-add-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Add Resource</h1>
    
    <div class="col-6 mx-auto">

        <?= $this->Form->create('add-rsrc-form', array('type' => 'file','url' => array('action' => 'add-resource')));
        $this->Form->unlockField('title');
        $this->Form->unlockField('resource');
        ?>
        <div class="form-group">
            <label>Select Page</label>
            <select class="form-control" name="resource">
                <option value="Select..." selected disabled>Choose resources page...</option>
                <option value="2">General Information</option>
                <option value="1">Technical Documentation</option>
                <option value="3">Application Information</option>
            </select>
        </div>

        <div class="form-group">
            <label>File Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter title copy...">
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