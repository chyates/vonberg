<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>

<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- <?= $this->Form->create('edit-rsrc-form', ['id' =>'edit-rsrc-form', 'enctype' => 'multipart/form-data']); ?> -->
    <h1 class="page-title">Edit or Delete Resources: Application Information</h1>

    <div id="delete-check-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col">
                        <h1 class="page-title">Delete File?</h1>
                        <p>Are you sure you want to delete</p>
                        <p id="partname">FPO FILE TEXT</p>
                        <p>from the system? This action cannot be undone.</p>
                        <div class="btn-row">
                            <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                            <a href="/admin/resource-delete/" method="POST" id='delete-confirm' class="btn btn-primary">DELETE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-10 mx-auto">
    <?php foreach($specs as $spec): ?>
        <div class="row no-gutters">
            <div class="col-12">
                <form class="edit-rsrc-form" action="/admin/edit-application-information" method="POST" id="<?= $spec->techID ?>">
                    <input type="hidden" name="tech_id" value="<?= $spec->techID; ?>">
                    <div class="spec-row row">
                        <div class="col-md-3">
                            <h4 class="rsrc-col-title">Edit Title</h4>
                            <input type="text" name="tech_title" class="form-control" placeholder="<?= $spec->title ?>">
                        </div>
                        <div class="col-md-3">
                            <h4 class="rsrc-col-title">Current File</h4>
                            <p>
                                <a href="<?= "/img/pdfs/technical_specifications/" . $spec->file; ?>" target="_blank">
                                    <?php echo $this->Text->truncate(
                                        $spec->file, 15, 
                                        [
                                            'ellipsis' => '...',
                                            'exact' => false
                                        ]); 
                                    ?>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="rsrc-col-title">Replace File</h4>
                            <div class="row no-gutters">
                                <div class="col">
                                    <label class="fileContainer">Browse
                                        <input type="file" name="file_path" class="form-control"/>
                                    </label>
                                    <p class="file-text">No file chosen</p>
                                    <input type="submit" class="btn btn-primary update-button" value="Replace">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr class="edit-rsrc-div">
    <?php endforeach; ?>
    </div>
</div><!-- #cms-edit-resource-main end -->