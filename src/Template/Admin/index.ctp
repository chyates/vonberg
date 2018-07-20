<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div id="cms-main-container" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Content Management System</h1>
    <p class="text-center"><a class="btn btn-primary mr-4" href="/admin/add-product" disabled>Add New Product</a><a class="btn btn-primary mr-4" href="/admin/generate-pdf" disabled>Generate Custom PDF</a><a class="btn btn-primary" href="/admin/manage-resources" disabled>Manage Resources</a></p>
    <hr class="resource-divider mb-5">
    
    <div class="col-10 mx-auto">
        <h2 class="category-title">CSV and Catalogue Files</h2>
        <div class="spec-row row mt-5">
            <div class="col-md-4">
                <h4 class="rsrc-col-title">Current File</h4>
            </div>
            <div class="col-md-3">
                <h4 class="rsrc-col-title">Last Updated</h4>
            </div>
            <div class="col-md-5">
                <h4 class="rsrc-col-title">Replace File</h4>
            </div>
        </div>
    
        <div id="prices-csv">
            <div class="prices row no-gutters py-3">
                <div class="col-12">
                    <?= $this->Form->create('up-prices', 
                    [
                        'id' => 'up-prices',
                        'class' => 'edit-rsrc-form',
                        'enctype' => 'multipart/form-data',
                        'url' => ['controller' => 'Admin', 'action' => 'priceImport']
                        ]);
                    ?>

                    <div class="spec-row row">
                        <div class="col-md-4">
                            <span class="pr-2">
                                <img class="img-fluid" src="/img/download.svg"/>
                            </span>
                            
                            <p>
                                <?php
                                    echo $this->Html->link(
                                        'model_prices.csv',
                                        '/admin/priceExport'
                                    );
                                ?>
                            </p>
                        </div>
                        
                        <div class="col-md-3">
                            <p>11/08/2017</p>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="row no-gutters">
                                <div class="col">
                                    <label class="fileContainer light">Browse
                                        <?php 
                                            echo $this->Form->input('filepath',
                                            [
                                                'type' => 'text',
                                                'class' => 'hidden form-control',
                                                'label' => false,
                                            ]); 
                                                
                                            echo $this->Form->input('csv_file',
                                            [
                                                'type' => 'file',
                                                'class' => 'form-control',
                                                'label' => false
                                            ]);
                                        ?>
                                    </label>
                                    <p class="file-text">No file chosen</p>
                                    <?php
                                        echo $this->Form->submit('replace',
                                        [
                                            'class' => 'btn btn-primary update-button',
                                            'value' => 'REPLACE',
                                        ]); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div><!-- #prices-csv end -->

        <div id="dealers-csv">
            <div class="dealers row no-gutters py-3">
                <div class="col-12">
                    <?= $this->Form->create('up-dealers', 
                    [
                        'id' => 'up-dealers',
                        'class' => 'edit-rsrc-form',
                        'enctype' => 'multipart/form-data',
                        'url' => ['controller' => 'Dealers', 'action' => 'index' ]
                        ]);
                    ?>

                    <div class="spec-row row">
                        <div class="col-md-4">
                            <span class="pr-2">
                                <img class="img-fluid" src="/img/download.svg"/>
                            </span>
                            
                            <p>
                                <?php
                                    echo $this->Html->link(
                                        'dealers.csv',
                                        '/dealers/dealerExport'
                                    );
                                ?>
                            </p>
                        </div>
                        
                        <div class="col-md-3">
                            <p><?= date('m/d/Y', $dealer_time);?></p>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="row no-gutters">
                                <div class="col">
                                    <label class="fileContainer light">Browse
                                        <?php 
                                            echo $this->Form->input('filepath',
                                            [
                                                'type' => 'text',
                                                'class' => 'hidden form-control',
                                                'label' => false,
                                            ]); 
                                                
                                            echo $this->Form->input('upload',
                                            [
                                                'type' => 'file',
                                                'class' => 'form-control',
                                                'label' => false
                                            ]);
                                        ?>
                                    </label>
                                    <p class="file-text">No file chosen</p>
                                    <?php
                                        echo $this->Form->submit('replace',
                                        [
                                            'class' => 'btn btn-primary update-button',
                                            'value' => 'REPLACE',
                                        ]); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div><!-- #dealers-csv end -->

        <div id="catalog-row">
            <div class="catalog row no-gutters py-3">
                <div class="col-12">
                    <?= $this->Form->create('up-catalog', 
                    [
                        'id' => 'up-catalog',
                        'class' => 'edit-rsrc-form',
                        'enctype' => 'multipart/form-data',
                        'url' => ['controller' => 'Admin', 'action' => 'replaceCatalog']
                        ]);
                    ?>

                    <div class="spec-row row">
                        <div class="col-md-4">
                            <span class="pr-2">
                                <img class="img-fluid" src="/img/download.svg"/>
                            </span>
                            
                            <p>
                                <?php
                                    echo $this->Html->link(
                                        'VonbergCatalogue.pdf',
                                        '/img/pdfs/VONBERG-Product_Catalog.pdf',
                                        [ 'target' => '_blank']
                                    );
                                ?>
                            </p>
                        </div>
                        
                        <div class="col-md-3">
                            <p><?= date('m/d/Y', $catalog_time);?></p>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="row no-gutters">
                                <div class="col">
                                    <label class="fileContainer light">Browse
                                        <?php 
                                            echo $this->Form->input('filepath',
                                            [
                                                'type' => 'text',
                                                'class' => 'hidden form-control',
                                                'label' => false,
                                            ]); 
                                                
                                            echo $this->Form->input('catalog_file',
                                            [
                                                'type' => 'file',
                                                'class' => 'form-control',
                                                'label' => false
                                            ]);
                                        ?>
                                    </label>
                                    <p class="file-text">No file chosen</p>
                                    <?php
                                        echo $this->Form->submit('replace',
                                        [
                                            'class' => 'btn btn-primary update-button',
                                            'value' => 'REPLACE',
                                        ]); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div><!-- #dealers-csv end -->
    </div>
</div>