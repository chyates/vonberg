<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div id="cms-prod-cat-main" class="inner-main col-md-10 mx-auto p-5">

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

    <div class="row">
        <div class="col-xs-4">
            <nav class="large-3 medium-4 columns" id="actions-sidebar">
                <ul class="side-nav">
                    <li class="heading"><?= __('Actions') ?></li>
                    <li><?= $this->Html->link(__('New Part'), ['action' => 'add']) ?></li>
                    <LI> <?= $this->Form->create('Part', array('url' => array('action' => 'index'), 'enctype' => 'multipart/form-data'));
                        echo $this->Form->input('upload', array('type' => 'file'));
                        echo $this->Form->button('Upload CSV File', ['class' => 'btn btn-lg btn-success1 btn-block padding-t-b-15']);
                        echo $this->Form->end();
                        ?>
                </ul>
            </nav>
        </div>
    </div>
    <h1 class="page-title"><?= __($pagename) ?></h1>
    <div class="table-responsive">
        <table id="cms-prod-cat-table" class="model-table table table-striped">
            <thead>
                <tr>
                    <th class="model-table-header" scope="col">Series</th>
                    <th class="model-table-header" scope="col">Style</th>
                    <th class="model-table-header" scope="col">Description</th>
                    <th class="model-table-header" scope="col">Subcategory</th>
                    <th class="model-table-header" scope="col">Last Updated</th>
                    <th class="actions model-table-header" scope="col"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parts as $part): ?>
                <tr>
                    <td class="model-table-data"><?= h($part->series->name) ?></td>
                    <td class="model-table-data"><?= h($part->style->name) ?></td>
                    <td class="model-table-data"><?= h($part->connection->name) ?></td>
                    <td class="model-table-data"><?= h($part->type->name) ?></td>
                    <td class="model-table-data"><?= h(date('M j Y', strtotime($part->last_updated)))?></td>
                    <td class="model-table-data actions">
                        <?= $this->Html->link(__('View'), ['controller'=>'Products','action' => 'view', $part->partID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit-product', $part->partID]) ?>
                        <a data-toggle="modal" data-target="#delete-check-modal">Delete</a>
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

