<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-five"class="active-title page-title">Edit Product: STP File Uploads</h1>

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