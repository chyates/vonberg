<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div class="container">
    <div class="row">
        <div class="col-xs-4">
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Export Dealers'), ['action' => 'dealerExport']) ?></li>
        <li><?= $this->Html->link(__('New Dealer'), ['action' => 'add']) ?></li>
<LI> <?= $this->Form->create('Dealer', array('url' => array('action' => 'index'), 'enctype' => 'multipart/form-data'));
        echo $this->Form->input('upload', array('type' => 'file'));
echo $this->Form->button('Upload CSV File', ['class' => 'btn btn-lg btn-success1 btn-block padding-t-b-15']);
echo $this->Form->end();     
?>
    </ul>
</nav>
</div>
<div class="dealers index col-xs-8">
    <h3><?= __('Dealers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telephone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lng') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dealers as $dealer): ?>
            <tr>
                <td><?= $this->Number->format($dealer->id) ?></td>
                <td><?= h($dealer->name) ?></td>
                <td><?= h($dealer->address) ?></td>
                <td><?= h($dealer->address1) ?></td>
                <td><?= h($dealer->address2) ?></td>
                <td><?= h($dealer->city) ?></td>
                <td><?= h($dealer->state) ?></td>
                <td><?= h($dealer->zip) ?></td>
                <td><?= h($dealer->country) ?></td>
                <td><?= h($dealer->telephone) ?></td>
                <td><?= h($dealer->fax) ?></td>
                <td><?= $this->Number->format($dealer->lat) ?></td>
                <td><?= $this->Number->format($dealer->lng) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dealer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dealer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dealer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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


