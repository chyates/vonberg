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
    
    <div id="cms-home-table" class="table-responsive">
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
                <!-- This content should be replaced with database logic.
                
                The current file column will contain a link to existing CSVs, and the last updated column should start with the most recent first. -->

                <tr>
                    <td>ProductInformation.csv</td>
                    <td>2017-11-08 13:46:02</td>
                    <td><button type="button" class="btn btn-primary">Browse</button></td>
                    <td>No file chosen</td>
                </tr>
                <tr>
                    <td>DistributorInformation.csv</td>
                    <td>2017-11-08 13:46:02</td>
                    <td><button type="button" class="btn btn-primary">Browse</button></td>
                    <td>No file chosen</td>
                </tr>
                <tr>
                    <td>VonbergCatalogue.pdf</td>
                    <td>2017-11-08 13:46:02</td>
                    <td><button type="button" class="btn btn-primary">Browse</button></td>
                    <td>No file chosen</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

