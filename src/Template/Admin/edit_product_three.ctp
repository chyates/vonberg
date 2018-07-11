<!-- Bringing it back old school -->
<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-three" class="active-title page-title">Edit Product: Series Table</h1>
    <?= $this->Form->create('', ['id' => "edit-prod-three-form"]) ?>
    <div id="three" class="active-slide form-slide">
        <div class="buffer-div">
            <div class="table-create-box p-3">
                <div class="creation-row row no-gutters">
                    <?php if(count($table) < 1) { ?>
                        <div class="data-column" id="1">
                            <?php 
                                echo $this->Form->input('table_header_1-1',
                                [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'model-header-input form-control',
                                    'placeholder' => 'Model',
                                    'id' => '1-1'
                                ]);
                                echo $this->Form->input('table_row_2-1', 
                                [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'model-row-input form-control',
                                    'placeholder' => 'Enter model',
                                    'id' => '2-1'
                                ]); 
                            ?>
                        </div>
                    <?php } else { 
                        $colCount = 1;
                        $rowCount = 1;
                        $divCount = count($table->model_table_headers);
                        $headArr = array();
                        $rowArr = array();
                        foreach($table->model_table_headers as $table_header){
                            echo $table_header->model_table_text;
                            // $headArr[$table_header->$model_table_text] = $table_header->model_table_text;
                        }
                        
                        foreach($table->model_table_rows as $table_row){
                            echo $table_row->model_table_row_text;
                            // $rowArr[strval($table_row->$model_table_row_text)] = $table_row->model_table_row_text;
                        }

                        print_r($rowArr);
                        // $sortedRows = array();
                        // for($j = 0; $j < count($rowArr); $j++) {

                        // }
                        while($divCount > 0):
                    ?>
                        <div class="data-column" id="<?= strval($colCount); ?>">
                        <?php 
                            for($i = 0; $i < count($headArr); $i++){
                                echo $this->Form->input('table_header_'.strval($rowCount).'-'.strval($colCount),
                                [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'model-header-input form-control',
                                    'value' => $headArr[$i],
                                    'id' => strval($rowCount).'-'.strval($colCount)
                                ]);
                                $colCount++;
                            }
                            foreach($table->model_table_rows as $table_row):
                                echo $this->Form->input('table_header_'.strval($rowCount).'-'.strval($colCount),
                                [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'model-row-input form-control',
                                    'value' => $table_row->model_table_row_text,
                                    'id' => strval($rowCount).'-'.strval($colCount)
                                ]);
                                $rowCount++;
                            endforeach;
                        ?>
                        </div>
                    <?php  
                        $divCount--;
                        if($rowCount % $colCount == 0) {
                            echo "</div>";
                            // $inCount = 0;
                        }
                        // $inCount++;
                        endwhile;
                        } 
                    ?>
                    <div class="add-column">
                        <a class="model-column add-bullet" href="">Add Column</a>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        <a class="model-row add-bullet" href="">Add Row</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters justify-content-between">
            <a href="/admin/edit-product-two/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
            <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
        </div>
    </div><!-- #three end -->
    <?= $this->Form->end(); ?>
</div><!-- edit-prod-main end -->