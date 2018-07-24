<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<div id="cms-edit-dealers" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit <?= $dealer->name; ?></h1>
    <div class="d-flex flex-row justify-content-around">
        <p><?= $this->Html->link(__('List of Dealers'), ['action' => 'index']) ?></p>
        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dealer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id)])?>
    </div>
    <div class="dealers form large-9 medium-8 columns content">
        <?= $this->Form->create($dealer, array(
            'class' => 'col-6 mx-auto',
            'id' => 'edit-dealer'
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

        <?= $this->Form->submit('Save', array('class' => 'btn btn-primary')); ?>
        <?= $this->Form->end() ?>
    </div>
</div>    