<div id="cms-manage-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Manage Application Information</h1>
    <p class="text-center">
        <a class="btn btn-primary mr-4" href="/admin/add-resource">Add New Resource</a><a class="btn btn-primary mr-4" href="/admin/edit-application-information">Edit or Delete Resources</a>
    </p>
    <hr class="resource-divider mb-5">

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
                    <td>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/download.svg"/>
                        </span>    
                        <a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank">
                            <?php echo $spec->file;?>
                        </a>
                    </td>
                    <td><?php echo ucwords(strtolower($spec->title)); ?></td>
                    <td><?php echo $spec->last_updated;?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
</div><!-- #cms-manage-resource-main end -->