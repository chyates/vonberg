<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>

<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit or Delete Resources: General Information</h1>

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
                    <td><input type="text" class="form-control form-control-sm" value="<?php echo $spec->title;?>"></td>
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
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <?php
                            echo $this->Html->link(
                                $this->Html->tag('delete', 'Delete'),
                                '#',
                                array(
                                    'id'=>'btn-confirm',
                                    'data-toggle'=> 'modal',
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

</div><!-- #cms-edit-resource-main end -->