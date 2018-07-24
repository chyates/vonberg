<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<div id="cms-single-dealer" class="inner-main col-md-10 mx-auto p-5">
    <div class="d-flex flex-row justify-content-around">
        <p><?= $this->Html->link(__('Edit Dealer'), ['action' => 'edit', $dealer->id]) ?> </p>
        <?= $this->Form->postLink(__('Delete Dealer'), ['action' => 'delete', $dealer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id)]) ?>
        <p><?= $this->Html->link(__('List of Dealers'), ['action' => 'index']) ?> </p>
        <p><?= $this->Html->link(__('Add Dealer'), ['action' => 'add']) ?> </p>
    </div>
    <div class="table-responsive">
        <h1 class="page-title">Distributor Information</h1>
        <table class=" model-table table table-striped">
            <tr>
                <th class="model-table-header text-right"><?= __('Company') ?></th>
                <td class="model-table-data"><?= h($dealer->name) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Address line 1') ?></th>
                <td class="model-table-data"><?= h($dealer->address1) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Address line 2') ?></th>
                <td class="model-table-data"><?= h($dealer->address2) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('City') ?></th>
                <td class="model-table-data"><?= h($dealer->city) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('State') ?></th>
                <td class="model-table-data"><?= h($dealer->state) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Zip') ?></th>
                <td class="model-table-data"><?= h($dealer->zip) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Country') ?></th>
                <?php if($dealer->country == '') { ?>
                    <td class="model-table-data">USA</td>
                <?php } else { ?>
                    <td class="model-table-data"><?= h($dealer->country) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Phone number') ?></th>
                <td class="model-table-data"><?= h($dealer->telephone) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Fax number') ?></th>
                <td class="model-table-data"><?= h($dealer->fax) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Latitude') ?></th>
                <td class="model-table-data"><?= $this->Number->format($dealer->lat) ?></td>
            </tr>
            <tr>
                <th class="model-table-header text-right"><?= __('Longitude') ?></th>
                <td class="model-table-data"><?= $this->Number->format($dealer->lng) ?></td>
            </tr>
        </table>
    </div>
</div>