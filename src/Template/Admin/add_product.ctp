<div id="cms-add-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- I believe the dropdowns should be populated from the database, ie. the select elements
    for category, type, series, short description, and specifications. -->
    <form id="add-prod-form">
        <h1 id="title-one" class="active-title page-title">Add New Product</h1>
        <h1 id="title-two" class="inactive-title page-title">Add New Product: Description and Features</h1>
        <h1 id="title-three" class="inactive-title page-title">Add New Product: Series Table</h1>
        <h1 id="title-four"class="inactive-title page-title">Add New Product: Image Uploads</h1>
        <h1 id="title-five"class="inactive-title page-title">Add New Product: STP File Uploads</h1>

        <div id="one" class="active-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="product-category">
                    <option value="Select..." selected disabled>Select...</option>
                </select>
            </div>

            <div class="row no-gutters">
                <div class="col-sm-6">
                    <label>Product Status</label>
                    <div class="form-check">
                        <input type="checkbox" name="new-status" class="form-check-input" value="new" checked>
                        <label class="form-check-label">New</label>
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
                <div class="form-check form-check-inline">
                    <input type="radio" name="product-style" class="form-check-input" value="inline">
                    <label class="form-check-label">Inline</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="product-style" class="form-check-input" value="cartridge">
                    <label class="form-check-label">Cartridge</label>
                </div>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="product-type">
                    <option value="Select..." selected disabled>Select...</option>
                </select>
            </div>

            <div class="form-group">
                <label>Series</label>
                <select class="form-control" name="product-series">
                    <option value="Select..." selected disabled>Select...</option>
                </select>
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
                <label>Detail Description:</label>
                <textarea class="form-control" name="product-detail-description" cols="50" rows="6"></textarea>
            </div>

            <div class="form-group w-bullet">
                <label>Operation</label>
                <input type="text" class="form-control" name="product-operation" placeholder="Enter bullet copy...">
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
                <a class="add-bullet" href="">Add Row</a>
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
</div><!-- #cms-add-prod-main end -->