<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-two" class="active-title page-title">Edit Product: Description and Features</h1>
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
    <div id="two" class="active-slide form-slide col-md-5 mx-auto">
        <div class="form-group">
            <?php echo $this->Form->control('description',['cols'=>50, 'rows'=>6,'class'=>'form-control','label'=>'Detail Description:']);?>
        </div>

        <div class="form-group w-bullet">
            <div class="form-group">
                <label>Operation</label>
                <?php 
                $op_count = 1;
                if(count($opblock) < 2) {
                    echo $this->Form->input('bullet_text', array('class' => 'form-control', 'label' => false, 'id' => 'bullet' . $op_count));
                } else {
                    foreach ($opblock as $op):
                        foreach ($op->text_block_bullets as $line):
                            if ($op->header == "Operation") {
                                echo $this->Form->input('text_block_bullets.'.$count.'.bullet_text', array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text, 'id' => 'bullet' . $op_count));
                                $count++;
                            }
                        endforeach;
                    endforeach;
                }
                ?>
                <a class="add-bullet" href="">Add Bullet</a>
            </div>
        </div>

        <div class="form-group w-bullet">
            <label>Features</label>
            <?php
            $feat_count = 1;
            if(count($opblock) < 2) {
                echo $this->Form->input('bullet_text', array('class' => 'form-control', 'label' => false, 'id' => 'bullet' . $feat_count));
            } else {
                foreach ($opblock as $op):
                    foreach ($op->text_block_bullets as $line):
                        if ($op->header == "Features") {
                            echo $this->Form->input('text_block_bullets.'.$feat_count.'.bullet_text', array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text));

                        }
                    endforeach;
                endforeach;
            } 
            ?>
            <a class="add-bullet" href="">Add Bullet</a>
        </div>

        <div class="form-group row no-gutters align-items-center w-bullet">
            <label>Specifications</label>
            <?php
            $index = 0;
            if (count($specs) > 2) {
                foreach ($specs as $spec){ ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo $this->Form->select(
                            'specifications.'.$index.'.spec_name',
                            [$spec->spec_name,'CLOSING FLOW TOLERANCE', 'DIVIDE / COMBINE RATIO', 'FLOW ADJUSTMENT RANGE', 'FLOW TOLERANCE', 'INTERNAL LEAKAGE','MAX. PRESSURE DIFFERENTIAL "1" TO "2"','OPERATING PRESSURE','PRESSURE RANGE','RELIEF ADJUSTMENT RANGE','RELIEF SETTING RANGE','RELIEF TOLERANCE','REOPENING DIFFERENTIAL','STANDARD CRACK PRESSURE','TEMPERATURE RANGE',],
                            ['value' => $spec->spec_name]
                            );?>
                        </div>
                        <div class="col-sm-6">
                            <?= $this->Form->input('specifications.'.$index.'.spec_value', array('class' => 'form-control','label'=> False, 'value' => $spec->spec_value));?>

                        </div>
                    </div>
            <?php 
                    $index++;
                }
            } else {
                $spec_array = [];
                foreach($all_specs as $each_spec) {
                    array_push($spec_array, $each_spec->spec_name); 
                } ?>
                    <div class="row">
                        <div class="col-sm-6">
                        <?php echo $this->Form->input('spec_name',
                        [
                            'type' => 'select',
                            'multiple' => false,
                            'options' => $spec_array,
                            'label' => false,
                            'class' => 'form-control'
                        ]);?>
                        </div>
                        <div class="col-sm-6">
                            <?= $this->Form->input('spec_value', array('class' => 'form-control','label'=> False));?>

                        </div>
                    </div>
            <?php 
            } ?>
        </div>
        <a class="add-bullet" href="">Add Bullet</a>
        <div class="row no-gutters justify-content-between">
            <a href="/admin/edit-product-one/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
            <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
        </div>
    </div><!-- #two end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->