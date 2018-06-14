<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-two" class="active-title page-title">Edit Product: Description and Features</h1>

        <div id="two" class="active-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <?php echo $this->Form->control('description',['cols'=>50, 'rows'=>6,'class'=>'form-control','label'=>'Detail Description:']);?>
            </div>

            <div class="form-group w-bullet">

                <div class="form-group">
                    <label>Operation</label>
                    <?php
                    foreach ($opblock as $op):
                        foreach ($op->text_block_bullets as $line):
                            if ($op->header == "Operation") {
                                echo $this->Form->input('feature_text', array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text));
                            }
                            endforeach;
                    endforeach;
                    ?>
                    <a class="add-bullet" href="">Add Bullet</a>
            </div>

            <div class="form-group w-bullet">
                <label>Features</label>
                <?php
                foreach ($opblock as $op):
                    foreach ($op->text_block_bullets as $line):
                        if ($op->header == "Features") {
                            echo $this->Form->input('feature_text', array('class' => 'form-control','label'=> False, 'value' => $line->bullet_text));
                        }
                    endforeach;
                endforeach;
                ?>
                <a class="add-bullet" href="">Add Bullet</a>
            </div>

            <div class="form-group row no-gutters align-items-center w-bullet">
                <div class="col-sm-4">
                    <label>Specifications</label>
                    <select class="form-control" name="product-specification">
                        <option value="Select..." selected disabled>Select...</option>
                    </select>
                <a class="add-bullet" href="">Add Bullet</a>
                </div>
                <div class="col-sm-8">
                    <input type="text" name="product-spec-detail" class="form-control" placeholder="Enter value...">
                </div>
            </div>
            <div class="row no-gutters justify-content-between">
                <a href="/admin/edit-product-one/<?= $part->partID ?>" class="back btn btn-primary">Back</a>
                <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- #two end -->
            <?= $this->Form->end(); ?>

        </div><!-- #cms-edit-prod-main end -->