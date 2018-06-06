<div id="cms-add-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Add Resource</h1>
    
    <div class="col-6 mx-auto">

        <form id="add-rsrc-form">
            <div class="form-group">
                <label>Select Page</label>
                <select class="form-control" name="rsrc-page">
                    <option value="Select..." selected disabled>Choose resources page...</option>
                    <option value="generalInformation">General Information</option>
                    <option value="technicalDocumentation">Technical Documentation</option>
                    <option value="applicationInformation">Application Information</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>File Title</label>
                <input type="text" class="form-control" name="product-operation" placeholder="Enter title copy...">
            </div>
            
            <div class="form-group">
                <label id="up-label-addrsrc">Upload File</label>
                <label class="fileContainer">Browse
                    <input id="add-rsrc-file" type="file" class="form-control"/>
                </label>
                <p>No file chosen</p>
            </div>
            
            <div class="form-group text-right">
                <label class="sr-only">Submit</label>
                <input id="add-rsrc-submit" type="submit" class="btn btn-primary" value="Add Resource">
            </div>
        </form>
    </div>
</div><!-- #cms-manage-resources-main end -->