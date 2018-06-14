<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create('', ['id' => "edit-prod-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-three" class="active-title page-title">Edit Product: Series Table</h1>


        <div id="three" class="active-slide form-slide">
            <div class="buffer-div">
                <div class="table-create-box p-3">
                    <div class="creation-row row no-gutters">
                            <?php $count = count($table->model_table_headers);
                            ?>
                            <?php foreach ($table->model_table_headers as $header):
                                $index = -1;
                                ?>
                            <div class="data-column">
                            <?php echo $this->Form->input('table_header', array('class' => 'model-header-input form-control','label'=> False, 'value' => $header->model_table_text));?>
                            <?php foreach ($table->model_table_rows as $row):
                                ++$index;
                                $debug = ($header->order_num+($index*$count));
                                if ($row->order_num == $debug) {
                                    echo $this->Form->input('table_header', array('class' => 'model-header-input form-control', 'label' => False, 'value' => $row->order_num));
                                }
                            endforeach; ?>
                            </div>
                            <?php endforeach;
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
                <a id="back-three" class="back btn btn-primary">Back</a>
                <a id="next-three" class="btn btn-primary">Next</a>
            </div>
        </div><!-- #three end -->

    </form>
</div><!-- #cms-edit-prod-main end -->