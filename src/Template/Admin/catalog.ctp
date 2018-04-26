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
                    <li><?= $this->Html->link(__('New Part'), ['action' => 'add']) ?></li>
                    <LI> <?= $this->Form->create('Part', array('url' => array('action' => 'index'), 'enctype' => 'multipart/form-data'));
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
                    <th scope="col"><?= $this->Paginator->sort('categoryID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('seriesID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('styleID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('connectionID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('typeID') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($parts as $part): ?>
                    <tr>
                        <td><?= h($part->category->name) ?></td>
                        <td><?= h($part->series->name) ?></td>
                        <td><?= h($part->style->name) ?></td>
                        <td><?= h($part->connection->name) ?></td>
                        <td><?= h($part->type->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $part->partID]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $part->partID]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $part->partID], ['confirm' => __('Are you sure you want to delete # {0}?', $part->partID)]) ?>
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

