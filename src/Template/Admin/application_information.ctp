<div id="cms-manage-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Manage Resource: Application Information</h1>
    <p class="text-center">
        <!-- The following information should be populated from the database. Also, the link for the Edit Resource button should link to the appropriate page depending on which resource the user is currently managing, ie. if they're managing General Information the edit link should direct to the Edit General Information page.  -->
        <a class="btn btn-primary mr-4" href="/admin/add-resource">Add New Resource</a><a class="btn btn-primary mr-4" href="/admin/edit-application-information">Edit or Delete Resources</a>
    </p>
    <hr>

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
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
            foreach ($specs as $spec): ?>
                <tr>
                    <td><?php echo $spec->file;?></td>
                    <td><?php echo $spec->title;?></td>
                    <td><?php echo $spec->last_updated;?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
</div><!-- #cms-manage-resource-main end -->