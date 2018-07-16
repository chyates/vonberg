<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>

<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <?= $this->Form->create('edit-rsrc-form', ['id' =>'edit-rsrc-form', 'enctype' => 'multipart/form-data']); ?>
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
                        <td>
                            <input type="text" class="title-in form-control" placeholder="<?php echo $spec->title;?>">
                        </td>
                        <td>
                            <a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank">
                                <?php echo $this->Text->truncate(
                                    $spec->file, 15, 
                                    [
                                        'ellipsis' => '...',
                                        'exact' => false
                                    ]); 
                                ?>
                            </a>
                        </td>
                        <td class="d-flex justify-content-between">
                            <label class="fileContainer">Browse
                                <input type="file" class="form-control"/>
                            </label>
                            <p class="file-text">No file chosen</p>
                            <?php 
                                echo $this->Form->input('tech_id', ['type' => 'hidden', 'label' => false, 'value' => $spec->techID]);
                                echo $this->Form->input('tech_title', ['type' => 'hidden', 'label' => false, 'placeholder' => $spec->title]);
                                echo $this->Form->input('file_path', ['type' => 'hidden', 'label' => false, 'placeholder' => $spec->file]);
                                echo $this->Form->submit('replace', array('class' => 'btn btn-primary update-button')); 
                            ?>
                            <!-- <form id="edit-rsrc-form" action=<?= "/admin/edit-application-information/".$spec->techID; ?> method="POST">
                            <input type="hidden" name="tech_title" value="<?php echo $spec->title; ?>">
                            <input type="hidden" name="path" value="<?php echo $spec->file; ?>">
                            <button type="submit" class="btn btn-primary update-button">Replace</button>
                        </form> -->
                        <?php
                            echo $this->Html->link(
                                $this->Html->tag('delete', 'Delete'),
                                '#',
                                array(
                                    'id'=>'btn-confirm',
                                    'data-toggle'=> 'modal',
                                    'data-id' => $spec->techID,
                                    'data-file'=> $spec->title,
                                    'data-target' => '#delete-check-modal',
                                    'data-action'=> Router::url(
                                        array('action'=>'resourceDelete', $spec->techID)
                                    ),
                                    'escape' => false),
                                    false
                                );
                                ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
    <?= $this->Form->end();  ?>
</div><!-- #cms-edit-resource-main end -->