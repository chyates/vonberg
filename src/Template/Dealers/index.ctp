<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div id="cms-dealers-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Distributors</h1>
    <div class="d-flex flex-row justify-content-around">
        <p><?= $this->Html->link(__('Export Dealers'), ['action' => 'dealerExport']) ?></p>
        <p><?= $this->Html->link(__('New Dealer'), ['action' => 'add']) ?></p>
    </div>
    <div class="d-flex flex-row justify-content-around mb-4">
        <?= $this->Form->create('Dealer', array
            (
                'url' => array('action' => 'index'), 
                'enctype' => 'multipart/form-data',
                'id' => 'index-dealers'
            ));
        ?>
        <label class="fileContainer dark">Browse
            <?php 
                echo $this->Form->input('upload', array(
                    'type' => 'file', 
                    'class' => 'form-control',
                    'label' => false
                )); 
                ?>
        </label>
        <p class="file-text">No file chosen</p>
        <?php 
            echo $this->Form->submit('Upload CSV File', ['class' => 'btn btn-primary']);
            echo $this->Form->end();     
        ?>
    </div>
    <div class="table-responsive">
        <table class="model-table table table-striped">
            <thead>
                <tr>
                    <th class="model-table-header"><?= $this->Paginator->sort('name') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('address1') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('address2') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('city') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('state') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('zip') ?></th>
                    <th class="model-table-header"><?= $this->Paginator->sort('country') ?></th>
                    <th class="model-table-header" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dealers as $dealer): ?>
                <tr>
                    <td class="model-table-data"><?= h($dealer->name) ?></td>
                    <td class="model-table-data"><?= h($dealer->address1) ?></td>
                    <td class="model-table-data"><?= h($dealer->address2) ?></td>
                    <td class="model-table-data"><?= h($dealer->city) ?></td>
                    <td class="model-table-data"><?= h($dealer->state) ?></td>
                    <td class="model-table-data"><?= h($dealer->zip) ?></td>
                    <td class="model-table-data"><?= h($dealer->country) ?></td>
                    <td class="model-table-data actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $dealer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dealer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dealer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
</div>


