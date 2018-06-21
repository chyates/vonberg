<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit Resources</h1>

    <div id="delete-check-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col">
                        <h1 class="page-title">Delete File?</h1>
                        <p>Are you sure you want to delete</p>
                        <p>FPO FILE TEXT</p>
                        <p>from the system? This action cannot be undone.</p>
                        <div class="btn-row">
                            <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- This template follows a similar format as the manage resources page, however the information for all of the resources is already populated from the database.
    
    Each category should have its own table with headers and a title. The PDFs should be sorted by category; there absolutely could be more than three per section.  

    Upon clicking the 'Update' button, the following should happen, depending on what the user changed:
        - the file should be updated in the database and the content in the 'Current File' column should change to reflect the update
        - the title of the file should be updated, on the page as well as in the database 
        - both should be updated -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">General Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="" data-toggle="modal" data-target="#delete-check-modal">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="" data-toggle="modal" data-target="#delete-check-modal">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="" data-toggle="modal" data-target="#delete-check-modal">Delete</a></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Technical Documentation</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Application Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" placeholder="File Title Displayed on Site"></td>
                    <td>FileName.pdf</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

</div><!-- #cms-edit-resource-main end -->