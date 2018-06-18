<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part[]|\Cake\Collection\CollectionInterface $parts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Part'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Connections'), ['controller' => 'Connections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Connection'), ['controller' => 'Connections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Styles'), ['controller' => 'Styles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Style'), ['controller' => 'Styles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Series'), ['controller' => 'Series', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Series'), ['controller' => 'Series', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Tables'), ['controller' => 'ModelTables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Table'), ['controller' => 'ModelTables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Text Blocks'), ['controller' => 'TextBlocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Text Block'), ['controller' => 'TextBlocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Specifications'), ['controller' => 'Specifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Specification'), ['controller' => 'Specifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parts index large-9 medium-8 columns content">
    <h3><?= __('Parts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('partID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categoryID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seriesID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('styleID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('connectionID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('typeID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parts as $part): ?>
            <tr>
                <td><?= $this->Number->format($part->partID) ?></td>
                <td><?= $part->has('category') ? $this->Html->link($part->category->name, ['controller' => 'Categories', 'action' => 'view', $part->category->categoryID]) : '' ?></td>
                <td><?= $part->has('series') ? $this->Html->link($part->series->name, ['controller' => 'Series', 'action' => 'view', $part->series->seriesID]) : '' ?></td>
                <td><?= $part->has('style') ? $this->Html->link($part->style->name, ['controller' => 'Styles', 'action' => 'view', $part->style->styleID]) : '' ?></td>
                <td><?= $part->has('connection') ? $this->Html->link($part->connection->name, ['controller' => 'Connections', 'action' => 'view', $part->connection->connectionID]) : '' ?></td>
                <td><?= $part->has('type') ? $this->Html->link($part->type->name, ['controller' => 'Types', 'action' => 'view', $part->type->typesID]) : '' ?></td>
                <td><?= h($part->last_updated) ?></td>
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
