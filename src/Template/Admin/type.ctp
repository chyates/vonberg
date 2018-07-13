<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
use Cake\Routing\Router;
?>
<div id="cms-prod-cat-main" class="inner-main col-md-10 mx-auto p-5">

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
                                array('action' => 'partDelete'),
                                array('id'=>'delete-confirm','class' => 'btn btn-primary'),
                                false);
        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <tr>
                    <td class="model-table-data"><?= h($part->series->name) ?></td>
                    <td class="model-table-data"><?= h($part->style->name) ?></td>
                    <td class="model-table-data"><?= h($part->connection->name) ?></td>
                    <td class="model-table-data"><?= h(date('M j Y', strtotime($part->last_updated)))?></td>
                    <td class="model-table-data">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="new-status" value="54days"
                                   checked>
                            <label class="form-check-label">54 days</label>
                        </div>
                    <td class="model-table-data actions">
                        <?= $this->Html->link(__('View'), ['controller'=>'Products','action' => 'view', $part->partID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit-product', $part->partID]) ?>
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('delete', 'Delete'),
                            '#',
                            array(
                                'id'=>'btn-confirm',
                                'data-toggle'=> 'modal',
                                'data-file'=> $part->series->name,
                                'data-target' => '#delete-check-modal',
                                'data-action'=> Router::url(
                                    array('action'=>'deletePart',$part->partID)
                                ),
                                'escape' => false),
                            false);
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