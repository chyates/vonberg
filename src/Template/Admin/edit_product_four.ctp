<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-four"class="active-title page-title">Edit Product: Image Uploads</h1>
    <?= $this->Form->create('edit-prod-form', ['id' => "edit-prod-form", 'enctype' => 'multipart/form-data']) ?>

        <div id="four" class="active-slide form-slide col-md-8 mx-auto table-responsive">
            <table class="model-table table">
                <thead>
                    <tr>
                        <th class="model-table-header">Image</th>
                        <th class="model-table-header">Current File</th>
                        <th class="model-table-header">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="model-table-data">Product Image</td>
                        <td class="model-table-data">
                        <?php    
                        if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/schematic_drawing.jpg')) {
                                echo "None";
                            } else {
                                echo "schematic_drawing.jpg";
                                echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/schematic_drawing.jpg'));
                        } ?>
                        </td>
                        <td class="model-table-data justify-content-between">
                            <label class="fileContainer">Browse
                                <?php echo $this->Form->input('schematic', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="model-table-data">Typical Performance</td>
                        <td class="model-table-data">
                            <?php    
                                if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/typical_performance.jpg')) {
                                    echo "None";
                                } else {
                                    echo "typical_performance.jpg";
                                    echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/hydraulic_symbol.jpg'));
                            } ?>
                        </td>
                        <td class="model-table-data justify-content-between">
                            <label class="fileContainer">Browse
                                <?php echo $this->Form->input('performance', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="model-table-data">Schematic Drawing</td>
                        <td class="model-table-data">
                            <?php    
                                if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/hydraulic_symbol.jpg')) {
                                    echo "None";
                                } else {
                                    echo "hydraulic_symbol.jpg";
                                    echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/typical_performance.jpg'));
                            } ?>

                            </td>
                        <td class="model-table-data justify-content-between">
                            <label class="fileContainer">Browse
                                <?php echo $this->Form->input('hydraulic', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="model-table-data">Ordering Information</td>
                        <td class="model-table-data">
                            <?php    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/ordering_information.jpg')) {
                                echo "None";
                            } else {
                                echo "ordering_information.jpg";
                                echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/ordering_information.jpg'));
                            } ?>
                        </td>
                        <td class="model-table-data justify-content-between">
                            <label class="fileContainer">Browse
                                <?php echo $this->Form->input('ordering', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="row no-gutters justify-content-between">
                <a id="back-four" class="back btn btn-primary">Back</a>
                <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- #four end -->

    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->