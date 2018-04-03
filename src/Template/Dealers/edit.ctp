<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dealer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dealers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dealers form large-9 medium-8 columns content">
    <?= $this->Form->create($dealer) ?>
    <fieldset>
        <legend><?= __('Edit Dealer') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('address1');
            echo $this->Form->control('address2');
            echo $this->Form->control('city');
            echo $this->Form->control('state');
            echo $this->Form->control('zip');
            echo $this->Form->control('country');
            echo $this->Form->control('telephone');
            echo $this->Form->control('fax');
            echo $this->Form->control('lat');
            echo $this->Form->control('lng');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
