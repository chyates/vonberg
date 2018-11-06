<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>
<div id="cms-prod-cat-main" class="inner-main col-md-10 mx-auto p-5">
    <?php foreach($parts as $modal_part) : ?>
        <div id="<?= $modal_part->partID; ?>" class="delete-modal modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col">
                            <h1 class="page-title">Delete File?</h1>
                            <p>Are you sure you want to delete</p>
                            <p id="partname">
                                <?php 
                                    if(!empty($modal_part->series->name)) {
                                        echo $modal_part->series->name;
                                    } elseif(empty($modal_part->series->name) || $modal_part->seriesID == "0") {
                                        echo "No series";
                                    } 
                                ?>
                            </p>
                            <p>from the system? This action cannot be undone.</p>
                            <div class="btn-row">
                                <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                                <?php
                                    echo $this->Form->postLink(
                                        'Delete',
                                        array('action' => 'partDelete', $modal_part->partID),
                                        array('id'=>'delete-confirm','class' => 'btn btn-primary'),
                                    false);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <h1 class="page-title"><?= __($pagename) ?></h1>
    <div class="table-responsive">
        <table id="cms-prod-cat-table" class="model-table table table-striped">
            <thead>
            <tr>
                <th class="model-table-header">Series</th>
                <th class="model-table-header">Style</th>
                <th class="model-table-header">Description</th>
                <th class="model-table-header">Last Updated</th>
                <th class="model-table-header">New</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parts as $part): ?>
                <tr id="<?= $part->partID ?>">
                    <td class="model-table-data">
                        <?php if(!empty($part->series->name)) {
                            echo $part->series->name;
                        } elseif(empty($part->series->name) || $part->seriesID == "0") {
                            echo "No series";
                        } ?>
                    </td>
                    <td class="model-table-data">
                        <?php if(!empty($part->style->name)) {
                            echo $part->style->name;
                        } elseif(empty($part->style->name) || $part->styleID == "0") {
                            echo "No style";
                        } ?>
                    </td>
                    <td class="model-table-data">
                        <?php if(!empty($part->connection->name)) {
                            echo $part->connection->name;
                        } elseif(empty($part->connection->name) || $part->connectionID == "0") {
                            echo "No connection";
                        } ?>
                    </td>
                    <td class="model-table-data"><?= h(date('M j Y', strtotime($part->last_updated)))?></td>
                    <td class="model-table-data">
                        <div class="form-check form-check-inline">
                            <input type="hidden" class="form-control" name="part_id" value="<?= $part->partID ?>"/>
                            <?php if($part->new_list == 1) { ?>
                                <input type="text" value="<?= $part->partID; ?>" class="form-control hidden" name="hid_part">
                                <input class="form-check-input" type="checkbox" name="new_list" value="<?= $part->expires; ?>" checked>
                                <label class="form-check-label"><?= h($part->expires) ?> days</label>
                            <?php } else { ?>
                                <input type="text" value="<?= $part->partID; ?>" class="form-control hidden" name="hid_part">
                                <input class="form-check-input" type="checkbox" name="new_list">
                            <?php } ?>
                        </div>
                    <td class="model-table-data actions">
                        <?= $this->Html->link(__('View'), ['controller'=>'Products','action' => 'view', $part->partID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit-product', $part->partID]) ?>
                        <?= $this->Html->link(__('Duplicate'), ['action' => 'duplicate', $part->partID]) ?>
                        <?php 
                            if(!empty($part->series->name)) {
                                echo $this->Html->link(
                                    $this->Html->tag('delete', 'Delete'), '#',
                                    array(
                                        'id'=>'btn-confirm',
                                        'data-toggle'=> 'modal',
                                        'data-file'=> $part->series->name,
                                        'data-target' => '#'.$part->partID,
                                        'data-action'=> Router::url(
                                            array('action'=>'partDelete',$part->partID)
                                        ),
                                        'escape' => false
                                    ),
                                false);
                            } elseif(empty($part->series->name) || $part->seriesID == "0") {
                                echo $this->Html->link(
                                    $this->Html->tag('delete', 'Delete'), '#',
                                    array(
                                        'id'=>'btn-confirm',
                                        'data-toggle'=> 'modal',
                                        'data-file'=> "No series",
                                        'data-target' => '#'.$part->partID,
                                        'data-action'=> Router::url(
                                            array('action'=>'partDelete',$part->partID)
                                        ),
                                        'escape' => false
                                    ),
                                false);
                            }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- .table-responsive end -->
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>