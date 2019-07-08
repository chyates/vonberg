<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-four"class="active-title page-title"><?= "Edit Product: " . $part->series->name . " Image Uploads" ?></h1>
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
                        <td class="first model-table-data">Product Thumbnail</td>
                        <td class="model-table-data">
                        <?php    
                        if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/thumbnail.jpg')) {
                                echo "None";
                            } else {
                                echo strval($part->partID). "/thumbnail.jpg"; 
                            ?>
                                <div class="remove">
                                    <?php
                                        echo $this->Form->input('kill-thumbnail',
                                        [
                                            'templates' => [
                                                'inputContainer' => '<div class="form-check form-check-inline {{type}}">{{content}}</div>'
                                            ],
                                            'type' => 'checkbox',
                                            'label' => false,
                                            'class' => 'form-check-input'
                                        ]);
                                    ?>
                                    <label class="follow-me">Remove File</label>
                                </div>
                            <?php } ?>
                        </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php 
                                    echo $this->Form->input('thumbnail', 
                                    [
                                        'type' => 'file',
                                        'class'=>'form-control',
                                        'label' => false
                                    ]);
                                ?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- thumbnail row end -->

                    <tr>
                        <td class="first model-table-data">Product Image</td>
                        <td class="model-table-data">
                        <?php    
                        if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/product_image.jpg')) {
                                echo "None";
                            } else {
                                echo strval($part->partID). "/product_image.jpg";
                        ?>
                            <div class="remove">
                                <?php
                                    echo $this->Form->input('kill-product_image',
                                    [
                                        'templates' => [
                                            'inputContainer' => '<div class="form-check form-check-inline {{type}}">{{content}}</div>'
                                        ],
                                        'type' => 'checkbox',
                                        'label' => false,
                                        'class' => 'form-check-input'
                                    ]);
                                ?>
                                <label class="follow-me">Remove File</label>
                            </div>
                            <?php } ?>
                        </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php echo $this->Form->input('product_image', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- image row end -->

                    <tr>
                        <td class="first model-table-data">Schematic Drawing</td>
                        <td class="model-table-data">
                            <?php    
                                if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/schematic_drawing.jpg')) {
                                    echo "None";
                                } else {
                                    echo strval($part->partID). "/schematic_drawing.jpg";
                            ?>
                            <div class="remove">
                                <?php
                                    echo $this->Form->input('kill-schematic', 
                                    [
                                        'templates' => [
                                            'inputContainer' => '<div class="form-check form-check-inline {{type}}">{{content}}</div>'
                                        ],
                                        'type' => 'checkbox',
                                        'label' => false,
                                        'class' => 'form-check-input'
                                    ]);
                                ?>
                                <label class="follow-me">Remove File</label>
                            </div>
                            <?php } ?>
                            </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php echo $this->Form->input('schematic', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- schematic row end -->

                    <tr>
                        <td class="first model-table-data">Ordering Information</td>
                        <td class="model-table-data">
                            <?php if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/ordering_information.jpg')) {
                                echo "None";
                            } else {
                                echo strval($part->partID). "/ordering_information.jpg";
                            ?>
                            <div class="remove">
                                <?php
                                    echo $this->Form->input('kill-ordering',
                                    [
                                        'templates' => [
                                            'inputContainer' => '<div class="form-check form-check-inline {{type}}">{{content}}</div>'
                                        ],
                                        'type' => 'checkbox',
                                        'label' => false,
                                        'class' => 'form-check-input'
                                    ]);
                                ?>
                                <label class="follow-me">Remove File</label>
                            </div>
                            <?php } ?>
                        </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php echo $this->Form->input('ordering', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- ordering info row end -->

                    <tr>
                        <td class="first model-table-data">Typical Performance</td>
                        <td class="model-table-data">
                            <?php    
                                if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/typical_performance.jpg')) {
                                    echo "None";
                                } else {
                                    echo strval($part->partID). "/typical_performance.jpg";
                            ?>
                            <div class="remove">
                                <?php
                                    echo $this->Form->input('kill-performance',
                                    [
                                        'templates' => [
                                            'inputContainer' => '<div class="form-check form-check-inline {{type}}">{{content}}</div>'
                                        ],
                                        'type' => 'checkbox',
                                        'label' => false,
                                        'class' => 'form-check-input'
                                        ]);
                                ?>
                                <label class="follow-me">Remove File</label>
                            </div>
                            <?php } ?>
                        </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php echo $this->Form->input('performance', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- typical performance row end -->

                    <tr>
                        <td class="first model-table-data">Performance Graph</td>
                        <td class="model-table-data">
                            <?php    
                                if (!file_exists(WWW_ROOT.'img/parts/'.strval($part->partID).'/performance_graphs.pdf')) {
                                    echo "None";
                                } else {
                                    echo "parts/" .strval($part->partID). "/performance_graphs.pdf";
                            ?>
                            <div>
                                <label class="follow-me">Remove File</label>
                                <?php
                                    echo $this->Form->input('kill-graph',
                                    [
                                        'type' => 'checkbox',
                                        'label' => false
                                    ]);
                                ?>
                            </div>
                            <?php } ?>
                        </td>
                        <td class="d-flex model-table-data justify-content-between">
                            <label class="fileContainer light">Browse
                                <?php echo $this->Form->input('graph', ['type' => 'file', 'class'=>'form-control', 'label' => false]);?>
                            </label>
                            <p class="file-text">No file chosen</p>
                        </td>
                    </tr><!-- performance graph row end -->

                </tbody>
            </table>

            <div class="row no-gutters justify-content-between">
                <a id="back-four" class="back btn btn-primary" href=<?= "/admin/edit-product-three/". $part->partID ?>>Back</a>
                <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- #four end -->

    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->