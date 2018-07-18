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
                            <?php
                                echo $this->Form->postLink(
                                    'Delete',
                                    array('action' => 'resourceDelete'),
                                    array('id'=>'delete-confirm','class' => 'btn btn-primary'),
                                    false
                                );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-10 mx-auto">
        <div class="spec-row row">
            <div class="col-md-4">
                <h4 class="rsrc-col-title">Edit Title</h4>
            </div>
            <div class="col-md-3">
                <h4 class="rsrc-col-title">Current File</h4>
            </div>
            <div class="col-md-5">
                <h4 class="rsrc-col-title">Replace File</h4>
            </div>
        </div>
    <?php foreach($specs as $spec): ?>
        <div class="row no-gutters">
            <div class="col-12">
            <?= $this->Form->create('edit-app', [
                    'id' => 'edit-app',
                    'class' => 'edit-rsrc-form inactive',
                    'enctype' => 'multipart/form-data'
                ]); ?>
                <?php 
                    echo $this->Form->input('id', [
                        'label' => false,
                        'type' => 'text',
                        'value' => $spec->techID,
                        'class' => 'hidden form-control',
                    ]); 
                ?>
                <div class="spec-row row">
                    <div class="col-md-4">
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
                        <p>
                            <a href="<?= "/img/pdfs/technical_specifications/" . $spec->files; ?>" target="_blank">
                                <?php echo $this->Text->truncate(
                                    $spec->files, 15, 
                                    [
                                        'ellipsis' => '...',
                                        'exact' => false
                                    ]); 
                                ?>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-5">
                        <div class="row no-gutters">
                            <div class="col">
                                <label class="fileContainer dark">Browse
                                <?php 
                                    echo $this->Form->input('filepath', 
                                    [
                                        'type' => 'text',
                                        'class' => 'hidden form-control',
                                        'label' => false,
                                    ]); 
                                    echo $this->Form->input('app_file', 
                                    [
                                        'type' => 'file', 
                                        'class'=>'form-control', 
                                        'label' => false
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
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('delete', 'Delete'),
                                        '#',
                                        array(
                                            'id'=>'btn-confirm',
                                            'class' => 'delete-toggle-link',
                                            'data-toggle'=> 'modal',
                                            'data-file'=> $spec->title,
                                            'data-target' => '#delete-check-modal',
                                            'data-action'=> Router::url(
                                                array('action'=>'deleteResource', $spec->techID)
                                            ),
                                            'escape' => false),
                                        false
                                    );
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