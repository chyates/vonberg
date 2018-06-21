<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit or Delete Resources: Technical Documentation</h1>

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

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($specs as $spec): ?>
                <tr>
                <tr>
                    <td><input type="text" class="form-control form-control-sm" value="<?php echo $spec->title;?>"></td>
                    <td>
                        <a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank">
                            <?php echo $spec->file;?>
                        </a>
                    </td>
                    <td class="justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <P><?php
                            echo $this->Html->link('Delete',array('controller'=>'admin','action'=>'resourceDelete',$spec->techID),
                                array('confirm'=>'Are you sure you want to delete the image?'));
                            ?>                    </td>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
</div><!-- #cms-edit-resource-main end -->