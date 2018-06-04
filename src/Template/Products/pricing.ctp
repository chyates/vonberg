<div id="prices-results-main-container" class="inner-main col-10 mx-auto p-5">
    <div class="row no-gutters justify-content-center">
        <div class="col-lg-4 mr-3 px-4">
            <h1 class="page-header">Product Prices</h1>
            <label>Enter Model Number</label>
            <?php echo $this->Form->create(null, ['class'=>'form-inline','valueSources' => 'query','url' => ['controller' => 'Products', 'action' => 'pricing']]);
            // You'll need to populate $authors in the template from your controller
            echo $this->Form->control('q', ['label' => false,'type' => 'search','class'=>'form-control']);
            // Match the search param in your table configuration
            ?>
            <p class="text-center">or</p>
            <label>Select a Series</label>
<?php            echo $this->Form->input('seriesID',  array('label' => false,'type' => 'select','options'=> json_decode($series),'class'=>'form-control'));?>

            <!-- Once something is searched, whatever the user searched for should stay either in the text field or the select field -->
            <button class="btn my-4" type="submit">Get Prices</button>
<?php            echo $this->Form->end(); ?>

        </div>
        <div class="col-lg-4">
            <img class="img-fluid" src="/img/parts/1/schematic_drawing.jpg" alt="product-map">
        </div>
    </div>

    <!-- The following table should populate whichever data the user searched for -->
    <div class="series-model-table-row row mx-5 px-5">
        <div class="table-responsive">
            <table class="model-table table">
                <thead>
                <th class="model-table-header">Model</th>
                <th class="model-table-header">Series</th>
                <th class="model-table-header">Style / Type</th>
                <th class="model-table-header">Connections</th>
                <th class="model-table-header">Base Price</th>
                </thead>

                <tbody>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                <tr>
                    <td class="model-table-data">1302</td>
                    <td class="model-table-data">1/4-18 NPTF</td>
                    <td class="model-table-data">0.25 TO 6.0 GPM</td>
                    <td class="model-table-data">3.50</td>
                    <td class="model-table-data">0.938</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!-- .series-model-table end -->
    <div class="row no-gutters">
        <div class="col-lg-6 mx-auto">
            <p class="text-center mb-5"><a href="/contact">Contact us</a> for quantity discounts!</p>
            <h3 class="product-name text-center">Terms and Conditions</h3>
            <ul>
                <li class="mb-2">Base prices shown are for standard catalog products only, without any optional features. For pricing involving valve with optional features, please contact Vonberg</li>
                <li class="mb-2">Discounts are applied on an individual order basis according to the quantity of a given line item. A line item is defined by the particular flow rate or pressure setting of the valve.</li>
                <li class="mb-2">Blanket orders for specific valves will be accepted, however, quantities and releases must be declared when the order is placed.</li>
                <li class="mb-2">Rush Orders - Orders requiring shipment within 1 to 2 days, presuming that material and assembly time is available, will be subject to a $50.00 expedite charge per line item. If shipment is within 3 to 5 days, then it will be a $25.00 expedite fee.</li>
                <li class="mb-2">There is a 25 piece maximum per Rush Order. The expedite fee cannot be applied to meet the minimum order; it is a net cost.</li>
                <li class="mb-2">Minimum order/shipment: $50.00, F.O.B. Rolling Meadows, IL</li>
                <li class="mb-2">Payment Terms: Open account upon approval, Visa or MasterCard</li>
            </ul>
        </div>
    </div>
</div><!-- #prices-main end -->

