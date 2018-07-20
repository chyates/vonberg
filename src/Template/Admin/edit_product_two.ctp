<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-two" class="active-title page-title">Edit Product: Description and Features</h1>
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
    <div id="two" class="active-slide form-slide col-md-5 mx-auto">
        <div class="form-group">
            <?php echo $this->Form->control('description',['cols'=>50, 'rows'=>6,'class'=>'form-control','label'=>'Detail Description:']);?>
        </div>

        <div class="form-group w-bullet operation">
            <div class="form-group">
                <label>Operation</label>
                <?php 
                $op_count;
                if(!$opblock->count()) {
                    echo $this->Form->input('op_bullet_text_1', array('class' => 'form-control', 'label' => false, 'id' => '1'));
                } else {
                    $op_count = 1;
                    foreach ($opblock as $op):
                        foreach ($op->text_block_bullets as $line):
                            echo $this->Form->input('op_bullet_text_'.strval($op_count), array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text, 'id' => strval($op_count)));
                            $op_count++;
                        endforeach;
                    endforeach;
                }
                ?>
                <a class="plus add-bullet" href="">Add Bullet</a>
                <a class="del add-bullet" href="">Remove Bullet</a>
            </div>
        </div>

        <div class="form-group w-bullet features">
            <label>Features</label>
            <?php
            $feat_count;
            if(!$featblock->count()) {
                echo $this->Form->input('feat_bullet_text_1', array('class' => 'form-control', 'label' => false, 'id' => '1'));
            } else {
                $feat_count = 1;
                foreach ($featblock as $feat):
                    foreach ($feat->text_block_bullets as $line):
                        echo $this->Form->input('feat_bullet_text_'.strval($feat_count), array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text, 'id' => strval($feat_count)));
                        $feat_count++;
                    endforeach;
                endforeach;
            } 
            ?>
            <a class="plus add-bullet" href="">Add Bullet</a>
            <a class="del add-bullet" href="">Remove Bullet</a>
        </div>

        <div class="form-group row no-gutters align-items-center w-bullet">
            <label>Specifications</label>
            <?php
            $index = 0;
            $spec_array = [];
            $options = [];
            foreach($all_specs as $each_spec) {
                array_push($spec_array, $each_spec->spec_name);
            } 
            for($x = 0; $x < count($spec_array); $x++) {
                $options[$x] = ['text' => $spec_array[$x], 'value' => $spec_array[$x]];
            }
            if ($specs->count()) {
                foreach ($specs as $spec){ ?>
                    <div class="row specifications">
                        <div class="col-sm-6">
                            <?php echo $this->Form->select(
                            'spec_name_'.strval($index+1), $options,
                            ['value' => $spec->spec_name, 'class' => 'form-control', 'label' => false, 'id' => strval($index+1)]
                            );?>
                        </div>
                        <div class="col-sm-6">
                            <?= $this->Form->input('spec_value_'.strval($index+1), array('class' => 'form-control','label'=> False, 'value' => $spec->spec_value, 'id' => strval($index+1)));?>
                        </div>
                    </div>
                <?php 
                    $index++;
                } ?>
                <a class="plus add-bullet" href="">Add Bullet</a>
                <a class="del add-bullet" href="">Remove Bullet</a>
            <?php  } else { ?>
                    <div class="row specifications">
                        <div class="col-sm-6">
                        <?php echo $this->Form->select('spec_name_1', $options, ['class' => 'form-control', 'label' => false, 'id' => '1']);?>
                        </div>
                        <div class="col-sm-6">
                            <?= $this->Form->input('spec_value_1', array('class' => 'form-control','label'=> False, 'id' => '1'));?>
                        </div>
                    </div>
                    <a class="plus add-bullet" href="">Add Bullet</a>
                    <a class="del add-bullet" href="">Remove Bullet</a>
            <?php } ?>
        </div>
        <div class="row no-gutters justify-content-between">
            <a href="/admin/edit-product-one/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
            <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
        </div>
    </div><!-- #two end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->