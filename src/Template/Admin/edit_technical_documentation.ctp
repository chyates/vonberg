<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>

<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit or Delete Resources: Technical Documentation</h1>

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
                <?= $this->Form->create('edit-tech', [
                    'id' => $spec->techID,
                    'class' => 'edit-rsrc-form'
                ]); ?>
                <?php 
                    echo $this->Form->input('tech_id', [
                        'type' => 'hidden',
                        'value' => $spec->techID,
                    ]); 
                ?>
                <div class="spec-row row">
                    <div class="col-md-3">
                        <h4 class="rsrc-col-title">Edit Title</h4>
                        <?php 
                            echo $this->Form->input('tech_title', [
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => $spec->title,
                                'label' => false,
                            ]); 
                        ?>
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
                                    <?php 
                                        echo $this->Form->input('file_path', [
                                            'type' => 'file',
                                            'class' => 'form-control',
                                            'label' => false,
                                        ]);
                                    ?>
                                </label>
                                <p class="file-text">No file chosen</p>
                                <?php 
                                    echo $this->Form->submit('replace', [
                                        'class' => 'btn btn-primary update-button',
                                        'value' => 'REPLACE'
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <hr class="edit-rsrc-div">
    <?php endforeach; ?>
    </div>
</div><!-- #cms-edit-resource-main end -->