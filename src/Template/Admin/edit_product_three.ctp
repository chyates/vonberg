<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-three" class="active-title page-title"><?php echo "Edit Product: " . $part->series->name . " Series Table"; ?></h1>
    <?= $this->Form->create('', ['id' => "edit-prod-three-form"]) ?>
    <div id="three" class="active-slide form-slide">
        <div class="buffer-div">
            <div class="table-create-box p-3">
                <div class="creation-row row no-gutters">
                    <?php if(!isset($table) || count($table->model_table_headers) == 0) { ?>
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
                        </div><!-- data column end, new table -->
                        <div class="add-column">
                            <a class="model-column plus add-bullet" href="">Add Column</a>
                        </div>
                        <?php } else { 
                                $colCount = count($table->model_table_headers);
                                $headArray = array();
                                $rowArray = array();
                                $h = 0; 

                                foreach($table->model_table_headers as $table_header){
                                    $headArray[$h] = $table_header->model_table_text;
                                    $h++;
                                }

                                $r = 0;
                                foreach($table->model_table_rows as $table_row){
                                    $rowArray[$r] = $table_row->model_table_row_text;
                                    $r++;
                                }

                                $divCount = 0;
                                $finalArr = array();
                                while($divCount < $colCount) {
                                    for($j = 0; $j < $r; $j++) {
                                        if(($j % $colCount)-$divCount == 0) {
                                            array_push($finalArr, $rowArray[$j]);
                                        }
                                    } 
                                    $divCount++;
                                }
                                $vert_count = 1;
                                $rowtal = count($finalArr) / $colCount;
                            ?>
                            <div class="data-column" id="<?= $vert_count ?>">
                                <?php  
                                    $r_count = 1;
                                    $in_count = 2;
                                    $head_count = 0;
                                    for($k = 0; $k < count($finalArr); $k++) {
                                        if($head_count < $vert_count) {
                                            echo $this->Form->input('table_header_'.strval($r_count)."-".strval($vert_count),
                                            [
                                                'type' => 'text',
                                                'label' => false,
                                                'class' => 'model-header-input form-control',
                                                'value' => $headArray[$head_count],
                                                'id' => strval($r_count)."-".strval($vert_count)
                                            ]);
                                            $head_count++;
                                        }
                                        echo $this->Form->input('table_row_'.strval($in_count)."-".strval($vert_count), 
                                        [
                                            'type' => 'text',
                                            'label' => false,
                                            'class' => 'model-row-input form-control',
                                            'id' => strval($in_count)."-".strval($vert_count),
                                            'value' => $finalArr[$k],
                                        ]);

                                            if($in_count > $rowtal) {
                                                $vert_count++;
                                                if ($vert_count > $colCount) {
                                                    // echo "</div>";
                                                } else {
                                                    echo "</div><div class='data-column' id='".strval($vert_count)."'>";
                                                }
                                                $r_count = 0;
                                                $in_count = 1;             
                                            } 
                                            if($vert_count > $colCount) {
                                                $vert_count--;
                                                $in_count--;
                                            } 
                                            $r_count++;
                                            $in_count++;
                                        } 
                                    ?>
                                </div><!-- data column end, existing table -->
                                <div class="add-column">
                                    <a class="model-column plus add-bullet" href="">Add Column</a>
                                </div>
                            <?php } ?>
                </div><!-- creation row end -->
                <div class="row no-gutters">
                    <div class="col">
                        <a class="model-row plus add-bullet" href="">Add Row</a>
                    </div>
                </div><!-- add row row end -->
                <div class="empty-text success">
                    <p class="empty-err">There are one or more empty cells; please fill them out and re-submit. Or, delete an extra <a href="" class="del e-row add-bullet">row</a> or <a href="" class="del e-col add-bullet">column</a>.</p>
                </div>
            </div><!-- table create box end -->
        </div><!-- buffer div end -->
        
        <div class="row no-gutters mt-4">
            <div class="col-11 mx-auto">
                <a href="/admin/edit-product-two/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
                <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- navigation row end -->
    </div><!-- #three end -->
    <?= $this->Form->end(); ?>
</div><!-- edit-prod-main end -->

<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#edit-prod-three-form").submit(function(e){
            let inputs = $("#edit-prod-three-form").find("input[type=text]")
            let eCount = 0
            $(inputs).each(function(index) {
                if(!$(this).val()) {
                    eCount++
                }
            })

            if(eCount > 0) {
                e.preventDefault()
                let errDiv = $("#three").find("div.empty-text.success")
                $(errDiv).toggleClass('success failure')
            }
        })
    })
</script>