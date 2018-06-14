<div id="prices-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="row no-gutters justify-content-lg-center justify-content-sm-between">
        <div class="col-lg-4 col-sm-6 mr-lg-3 px-lg-4">
            <?php echo $this->Form->create(null, ['type' => 'get','valueSources' => 'query','url' => ['controller' => 'Products', 'action' => 'prices']]);?>
            <?PHP $this->Form->unlockField('q');?>
            <?PHP $this->Form->unlockField('seriesID');?>
            <h1 class="page-header">Product Prices</h1>
            <div class="form-group">
                <label>Enter Model Number</label>
                <input type="text" class="form-control" name="q">
            </div>
            <p class="text-center">or</p>
            <div class="form-group">
                <label>Select a Series</label>
                <select class="form-control" name="seriesID">
                    <option value="" selected="selected">Select from dropdown...</option>
                    <?php foreach($series as $item) { ?>
                        <option value="<?php echo $item['seriesID']; ?>"><?php echo $item['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            <input type="submit" class="btn btn-primary my-4" value="Get Prices"/>
            <?php echo $this->Form->end(); ?>
        </div>

        <div class="col-lg-4 col-sm-5">
            <img class="img-fluid" src="/img/product-prices-image@2x-min.png" alt="product-map">
        </div>
    </div>

    <?php if (!empty($prices)) { ?>
    <!-- The following table should populate whichever data the user searched for -->
    <div class="series-model-table-row row mx-5 px-5">
        <div class="table-responsive col-10 mx-auto">
            <table class="model-table table">
                <thead>
                <th class="model-table-header">Model</th>
                <th class="model-table-header">Series</th>
                <th class="model-table-header">Style</th>
                <th class="model-table-header">Connections</th>
                <th class="model-table-header">Base Price</th>
                </thead>

                <tbody>
                <?php foreach($prices as $price) { ?>
                <tr>
                    <td class="model-table-data"><?php echo $price['model_text']; ?></td>
                    <td class="model-table-data"><?php echo $price['series']; ?></td>
                    <td class="model-table-data"><?php echo $price['style']; ?></td>
                    <td class="model-table-data"><?php echo $price['conn']; ?></td>
                    <td class="prices-last model-table-data"><?php echo money_format('$%.2n', $price['unit_price']); ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div><!-- .series-model-table end -->
    <?php } ?>

    <div class="row no-gutters">
        <div class="col-sm-6 mx-auto">
            <p class="text-center mb-sm-5 my-3"><a href="/contact">Contact us</a> for quantity discounts!</p>
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