<div id="cms-manage-resources-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Manage Resources</h1>
    <p class="text-center"><a class="btn btn-primary mr-4" href="/admin/add-resource">Add New Resource</a><a class="btn btn-primary mr-4" href="/admin/edit-resources">Edit or Delete Resources</a></p>
    <hr>
    
    <!-- This content should be replaced with database logic.
    
    Each category should have its own table with headers and a title. The PDFs should be sorted by category; there absolutely could be more than three per section.  -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">General Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Title</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($generals as $spec): ?>
                    <tr>
                        <td><?php echo $spec->file;?></td>
                        <td><?php echo $spec->title;?></td>
                        <td><?php echo $spec->last_updated;?></td>
                    </tr>
                <?php endforeach;?>            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Technical Documentation</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Title</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($technicals as $spec): ?>
                    <tr>
                        <td><?php echo $spec->file;?></td>
                        <td><?php echo $spec->title;?></td>
                        <td><?php echo $spec->last_updated;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Application Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Title</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($applications as $spec): ?>
                    <tr>
                        <td><?php echo $spec->file;?></td>
                        <td><?php echo $spec->title;?></td>
                        <td><?php echo $spec->last_updated;?></td>
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
</div><!-- #cms-manage-resources-main end -->