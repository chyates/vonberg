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
    
    <div id="cms-home-table" class="table-responsive rsrc-table col-md-10 mx-auto">
        <h2 class="category-title">CSV and Catalogue Files</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Current File</th>
                    <th>Last Updated</th>
                    <th>Replace File</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/download.svg"/>
                        </span>
                        <a href="/admin/priceExport">model_prices.csv</a>
                    </td>
                    <td>11/08/2017</td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control">
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/download.svg"/>
                        </span>    
                        <?= $this->Html->link(__('dealers.csv'), ['action' => 'dealerExport']) ?>
                    </td>
                    <td><?= date('m/d/Y', $dealer_time);?></td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control">
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/download.svg"/>
                        </span>    
                        <a href="/img/pdfs/VONBERG-Product_Catalog.pdf" target="_blank">VonbergCatalogue.pdf</a></td>
                    <td><?= date('m/d/Y', $catalog_time);?></td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control">
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

