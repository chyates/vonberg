<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<div id="cms-add-dealers" class="inner-main col-md-10 mx-auto p-5">
    <h3 class="empty-data"><?= $this->Html->link(__('List of Dealers'), ['action' => 'index']) ?></h3>
    <h1 class="page-title"><?= __('Add Dealer') ?></h1>
    <?= $this->Form->create($dealer, array(
        'class' => 'col-6 mx-auto',
        'id' => 'add-dealer'
    )) ?>
    <div class="form-group">
        <label>Company</label>
        <?php
            echo $this->Form->control('name',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Address line 1</label>
        <?php 
            echo $this->Form->control('address1', 
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Address line 2</label>
        <?php 
            echo $this->Form->control('address2',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>City</label>
        <?php 
            echo $this->Form->control('city',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>State</label>
        <?php 
            echo $this->Form->control('state',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Zip code</label>
        <?php 
            echo $this->Form->control('zip',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Country</label>
        <?php 
            echo $this->Form->control('country',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Phone number</label>
        <?php 
            echo $this->Form->control('telephone',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Fax number</label>
        <?php 
            echo $this->Form->control('fax',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Latitude</label>
        <?php 
            echo $this->Form->control('lat',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <div class="form-group">
        <label>Longitude</label>
        <?php 
            echo $this->Form->control('lng',
            [
                'type' => 'text',
                'class' => 'form-control',
                'label' => false
            ]);
        ?>
    </div>

    <?= $this->Form->submit('Submit', array('class' => 'btn btn-primary')); ?>
    <?= $this->Form->end() ?>
</div>
