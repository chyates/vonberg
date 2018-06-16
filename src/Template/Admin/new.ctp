<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div id="cms-new-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Flow Regulating Valves</h1>
    <h2 class="category-title">Flow Regulators</h2>

    <div class="table-responsive">
        <table id="cms-new-prod-table" class="model-table table table-striped">
            <thead>
            <tr>
                <th class="model-table-header">Series</th>
                <th class="model-table-header">Style</th>
                <th class="model-table-header">Description</th>
                <th class="model-table-header">Last Updated</th>
                <th class="model-table-header">New</th>
            </tr>
            </thead>
            <tbody>
            <!-- This content should be replaced with products from the database that are tagged as new. For each category that the products have, the table headers should repeat -->
            <tr>
                <td class="model-table-data">1300 Series</td>
                <td class="model-table-data">Inline</td>
                <td class="model-table-data">Female NPTF Ports</td>
                <td class="model-table-data">2017-11-13 11:55:09</td>

                <!-- If the product is new, the checkbox should be checked and should show the time it has remaining to be new -->
                <td class="model-table-data">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="new-status" value="54days"
                               checked>
                        <label class="form-check-label">54 days</label>
                    </div>
                </td>

                <td class="model-table-data"><a href="">View</a><a href="">Edit</a><a href="/admin/edit-product">Duplicate</a><a href="">Delete</a></td>
            </tr>
            <tr>
                <td class="model-table-data">1300 Series</td>
                <td class="model-table-data">Inline</td>
                <td class="model-table-data">Female NPTF Ports</td>
                <td class="model-table-data">2017-11-13 11:55:09</td>
                <td class="model-table-data">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="new-status" value="54days"
                               checked>
                        <label class="form-check-label">54 days</label>
                    </div>
                </td>

                <td class="model-table-data"><a href="">View</a><a href="/admin/edit-product">Edit</a><a href="">Duplicate</a><a href="">Delete</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div><!-- #cms-new-prod-main end -->