<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part $part
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Part'), ['action' => 'edit', $part->partID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Part'), ['action' => 'delete', $part->partID], ['confirm' => __('Are you sure you want to delete # {0}?', $part->partID)]) ?> </li>
        <li><?= $this->Html->link(__('List Parts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Connections'), ['controller' => 'Connections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Connection'), ['controller' => 'Connections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Styles'), ['controller' => 'Styles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Style'), ['controller' => 'Styles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Series'), ['controller' => 'Series', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Series'), ['controller' => 'Series', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Model Tables'), ['controller' => 'ModelTables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Table'), ['controller' => 'ModelTables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Text Blocks'), ['controller' => 'TextBlocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Text Block'), ['controller' => 'TextBlocks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Specifications'), ['controller' => 'Specifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Specification'), ['controller' => 'Specifications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parts view large-9 medium-8 columns content">
    <h3><?= h($part->partID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $part->has('category') ? $this->Html->link($part->category->name, ['controller' => 'Categories', 'action' => 'view', $part->category->categoryID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Series') ?></th>
            <td><?= $part->has('series') ? $this->Html->link($part->series->name, ['controller' => 'Series', 'action' => 'view', $part->series->seriesID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Style') ?></th>
            <td><?= $part->has('style') ? $this->Html->link($part->style->name, ['controller' => 'Styles', 'action' => 'view', $part->style->styleID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Connection') ?></th>
            <td><?= $part->has('connection') ? $this->Html->link($part->connection->name, ['controller' => 'Connections', 'action' => 'view', $part->connection->connectionID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $part->has('type') ? $this->Html->link($part->type->name, ['controller' => 'Types', 'action' => 'view', $part->type->typesID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model Table') ?></th>
            <td><?= $part->has('model_table') ? $this->Html->link($part->model_table->model_tableID, ['controller' => 'ModelTables', 'action' => 'view', $part->model_table->model_tableID]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PartID') ?></th>
            <td><?= $this->Number->format($part->partID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($part->last_updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($part->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Text Blocks') ?></h4>
        <?php if (!empty($part->text_blocks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Text BlockID') ?></th>
                <th scope="col"><?= __('PartID') ?></th>
                <th scope="col"><?= __('Order Num') ?></th>
                <th scope="col"><?= __('Header') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($part->text_blocks as $textBlocks): ?>
            <tr>
                <td><?= h($textBlocks->text_blockID) ?></td>
                <td><?= h($textBlocks->partID) ?></td>
                <td><?= h($textBlocks->order_num) ?></td>
                <td><?= h($textBlocks->header) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TextBlocks', 'action' => 'view', $textBlocks->text_blockID]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TextBlocks', 'action' => 'edit', $textBlocks->text_blockID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TextBlocks', 'action' => 'delete', $textBlocks->text_blockID], ['confirm' => __('Are you sure you want to delete # {0}?', $textBlocks->text_blockID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Specifications') ?></h4>
        <?php if (!empty($part->specifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('SpecsID') ?></th>
                <th scope="col"><?= __('PartID') ?></th>
                <th scope="col"><?= __('Spec Name') ?></th>
                <th scope="col"><?= __('Spec Value') ?></th>
                <th scope="col"><?= __('Order Num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($part->specifications as $specifications): ?>
            <tr>
                <td><?= h($specifications->specsID) ?></td>
                <td><?= h($specifications->partID) ?></td>
                <td><?= h($specifications->spec_name) ?></td>
                <td><?= h($specifications->spec_value) ?></td>
                <td><?= h($specifications->order_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Specifications', 'action' => 'view', $specifications->specsID]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Specifications', 'action' => 'edit', $specifications->specsID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Specifications', 'action' => 'delete', $specifications->specsID], ['confirm' => __('Are you sure you want to delete # {0}?', $specifications->specsID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
