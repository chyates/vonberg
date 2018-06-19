<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div id="cms-main-container" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Content Management System</h1>
    <p class="text-center"><a class="btn btn-primary mr-4" href="/admin/add-product" disabled>Add New Product</a><a class="btn btn-primary mr-4" href="/admin/generate-pdf" disabled>Generate Custom PDF</a><a class="btn btn-primary" href="/admin/manage-resources" disabled>Manage Resources</a></p>
    <hr>
    
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
                    <td><a href="/admin/priceExport">model_prices.csv</a></td>
                    <td>2017-11-08 13:46:02</td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control">
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                    </td>
                </tr>
                <tr>
                    <td><?= $this->Html->link(__('dealers.csv'), ['action' => 'dealerExport']) ?></td>
                    <td><?= date('m/d/Y', $dealer_time);?></td>
                    <td>
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control">
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                    </td>
                </tr>
                <tr>
                    <td><a href="/img/pdfs/VONBERG-Product_Catalog.pdf" target="_blank">VonbergCatalogue.pdf</a></td>
                    <td><?= date('m/d/Y', $catalog_time);?></td>
                    <td>
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

