<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-one" class="active-title page-title">Edit Product</h1>
        <h1 id="title-two" class="inactive-title page-title">Edit Product: Description and Features</h1>
        <h1 id="title-three" class="inactive-title page-title">Edit Product: Series Table</h1>
        <h1 id="title-four"class="inactive-title page-title">Edit Product: Image Uploads</h1>
        <h1 id="title-five"class="inactive-title page-title">Edit Product: STP File Uploads</h1>

        <div id="one" class="active-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <?php echo $this->Form->input('categoryID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $cat,
                        'label' => 'Category',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <div class="row no-gutters">
                <div class="col-sm-6">
                    <label>Product Status</label>
                    <div class="form-check">
                        <input type="checkbox" name="new-status" class="form-check-input" value="new" checked>
                        <label class="form-check-label">Yes</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Expiration</label>
                    <select class="form-control" name="product-expiration">
                        <option value="Select..." selected disabled>Select...</option>
                    </select>
                </div>
            </div>

            <label>Style</label>
            <div class="form-group">
                <?php echo $this->Form->control('styleID',
                    [
                        'templates'  =>[ 'inputContainer' => '<div class="input form-check form-check-inline {{type}}{{required}}">{{content}}</div>'],
                        'type' => 'radio',
                        'multiple' => false,
                        'options' => $style,
                        'label' => False,
                        'class' => 'form-check-input'
                    ]);?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('typeID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $type,
                        'label' => 'Series',
                        'class' => 'form-control'
                    ]);?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('seriesID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $series,
                        'label' => 'Series',
                        'class' => 'form-control'
                    ]);?>

            </div>

            <div class="form-group">
                <label>Short Description</label>
                <select class="form-control" name="product-short-description">
                    <option value="Select..." selected disabled>Select...</option>
                </select>
            </div>
            <p class="text-right"><a id="next-one" class="btn btn-primary">Next</a></p>
        </div><!-- #one end -->

        <div id="two" class="inactive-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <?php echo $this->Form->control('description',['cols'=>50, 'rows'=>6,'class'=>'form-control','label'=>'Detail Description:']);?>
            </div>

            <div class="form-group w-bullet">

                <div class="form-group">
                    <?php echo $this->Form->input('text_block',
                        [
                            'type' => 'select',
                            'multiple' => false,
                            'options' => $opblock,
                            'label' => 'Operation',
                            'class' => 'form-control'
                        ]);?>
                <a class="add-bullet" href="">Add Bullet</a>
            </div>

            <div class="form-group w-bullet">
                <label>Features</label>
                <input type="text" class="form-control" name="product-features" placeholder="Enter bullet copy...">
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
                <a id="back-two" class="back btn btn-primary">Back</a>
                <a id="next-two" class="btn btn-primary">Next</a>
            </div>
        </div><!-- #two end -->

        <div id="three" class="inactive-slide form-slide">
            <div class="buffer-div">
                <div class="table-create-box p-3">
                    <div class="creation-row row no-gutters">
                        <div class="data-column">
                            <input type="text" class="model-header-input form-control" placeholder="Model" name="table-header">
                            <input type="text" class="model-name-input form-control" placeholder="Enter model" name="table-data">
                        </div>
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

        <div id="four" class="inactive-slide form-slide col-md-8 mx-auto table-responsive">
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
                        <td class="model-table-data">Model name</td>
                        <td class="model-table-data">None</td>
                        <td class="model-table-data">
                            <label class="fileContainer">Browse
                                <input id="image-file" type="file" class="form-control"/>
                            </label>
                        </td>
                        <td id="file-test" class="model-table-data">No file chosen</td>
                    </tr>
                </tbody>
            </table>

            <div class="row no-gutters justify-content-between">
                <a id="back-four" class="back btn btn-primary">Back</a>
                <a id="next-four" class="btn btn-primary">Next</a>
            </div>
        </div><!-- #four end -->

        <div id="five" class="inactive-slide form-slide col-md-8 mx-auto table-responsive">
            <table class="model-table table">
                <thead>
                    <tr>
                        <th class="model-table-header">Model</th>
                        <th class="model-table-header">Current File</th>
                        <th class="model-table-header">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="model-table-data">Model name</td>
                        <td class="model-table-data">None</td>
                        <td class="model-table-data">
                            <label class="fileContainer">Browse
                                <input id="stp-file" type="file" class="form-control"/>
                            </label>
                        </td>
                        <td id="file-test-2" class="model-table-data">No file chosen</td>
                    </tr>
                </tbody>
            </table>
            <div class="row no-gutters justify-content-between">
                <a id="back-five" class="back btn btn-primary">Back</a>
                <input id="submit-five" type="submit" class="btn btn-primary" value="Add Product">
            </div>
        </div><!-- #five end -->
    </form>
</div><!-- #cms-edit-prod-main end -->