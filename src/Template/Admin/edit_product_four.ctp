<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create('edit-prod-form', ['id' => "edit-prod-form", 'enctype' => 'multipart/form-data']) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-four"class="active-title page-title">Edit Product: Image Uploads</h1>

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
                        <td class="model-table-data"><?= $part->series->name ?></td>
                        <td class="model-table-data">
                        <?php    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/schematic_drawing.jpg')) {
                            echo "File does not exist yet: schematic_drawing.jpg";
                            } else {
                            echo "schematic_drawing.jpg";
                            echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/schematic_drawing.jpg'));
                        } ?>
                        </td>
                        <td class="model-table-data">
                            <?php echo $this->Form->input('schematic', ['type' => 'file', 'class'=>'form-control']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="model-table-data"><?= $part->series->name ?></td>
                        <td class="model-table-data">
                            <?php    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/typical_performance.jpg')) {
                                echo "File does not exist yet: typical_performance.jpg";
                            } else {
                                echo "typical_performance.jpg";
                                echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/hydraulic_symbol.jpg'));
                            } ?>


                        </td>
                        <td class="model-table-data">
                            <?php echo $this->Form->input('performance', ['type' => 'file', 'class'=>'form-control']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="model-table-data"><?= $part->series->name ?></td>
                        <td class="model-table-data">
                            <?php    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/hydraulic_symbol.jpg')) {
                                echo "File does not exist yet: hydraulic_symbol.jpg";
                            } else {
                                echo "hydraulic_symbol.jpg";
                                echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/typical_performance.jpg'));
                            } ?>

                            </td>
                        <td class="model-table-data">
                            <?php echo $this->Form->input('hydraulic', ['type' => 'file', 'class'=>'form-control']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="model-table-data"><?= $part->series->name ?></td>
                        <td class="model-table-data">
                            <?php    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/ordering_information.jpg')) {
                                echo "File does not exist yet: ordering_information.jpg";
                            } else {
                                echo "ordering_information.jpg";
                                echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/ordering_information.jpg'));
                            } ?>
                        </td>
                        <td class="model-table-data">
                            <?php echo $this->Form->input('ordering', ['type' => 'file', 'class'=>'form-control']);?>
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