<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-five"class="active-title page-title">Edit Product: STP File Uploads</h1>
    <?= $this->Form->create($part, ['id' => "edit-prod-form", 'enctype' => 'multipart/form-data']) ?>

        <div id="five" class="active-slide form-slide col-md-8 mx-auto table-responsive">
            <table class="model-table table">
                <thead>
                    <tr>
                        <th class="model-table-header">Model</th>
                        <th class="model-table-header">Current File</th>
                        <th class="model-table-header">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $count=0;
                $rowcount = 0;
               //  echo debug($table);
               if(isset($table)) {
                foreach ($table->model_table_headers as $header) {
                    ++$count;
                }
                foreach ($table->model_table_rows as $row){
                    if ($rowcount % $count == 0 ) {
                        ?>
                        <tr>
                            <td class="model-table-data"><?= $row->model_table_row_text ?></td>
                            <td class="model-table-data">
                                <?php
                                    clearstatcache();
                                    $ext = "/". strval($row->model_table_rowID) . ".stp";
                                    echo $ext;
                                    // echo "img/parts/" . strval($part->partID) . "/" . strval($row->model_table_rowID) . ".stp";
                                    if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID) . strval($ext))) {
                                        echo "No current file";
                                    } else {
                                        // echo "<BR>updated: ".date('m/d/Y', filemtime(WWW_ROOT.'img/parts/'.strval($part->partID).'/'.strval($row->model_table_rowID).'.STP'));
                                        echo strval($row->model_table_rowID) . ".stp";
                                    } 
                                ?>
                            </td>
                            <td class="d-flex model-table-data justify-content-between">
                                <label class="fileContainer dark">Browse
                                    <?php echo $this->Form->input('stp_files[]', ['label'=>False, 'type' => 'file', 'class'=>'form-control']);?>
                                </label>
                                <?php echo $this->Form->hidden('filename[]', ['default' => $row->model_table_rowID]);?>
                                <p class="file-text">No file chosen</p>
                            </td>
                        </tr>

                        <?php
                    }
                    ++$rowcount;
                } 
               }  ?>
                </tbody>
            </table>
            <div class="row no-gutters justify-content-between">
                <a id="back-five" class="back btn btn-primary" href=<?= "/admin/edit-product-four/". $part->partID ?>>Back</a>
                <?= $this->Form->submit('Add product',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- #five end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->