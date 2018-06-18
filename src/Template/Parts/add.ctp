<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part $part
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Parts'), ['action' => 'index']) ?></li>
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
<div class="parts form large-9 medium-8 columns content">
    <?= $this->Form->create($part) ?>
    <fieldset>
        <legend><?= __('Add Part') ?></legend>
        <?php
            echo $this->Form->control('categoryID', ['options' => $categories, 'empty' => true]);
            echo $this->Form->control('seriesID', ['options' => $series, 'empty' => true]);
            echo $this->Form->control('styleID', ['options' => $styles, 'empty' => true]);
            echo $this->Form->control('connectionID', ['options' => $connections, 'empty' => true]);
            echo $this->Form->control('typeID', ['options' => $types, 'empty' => true]);
            echo $this->Form->control('description');
            echo $this->Form->control('last_updated');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
