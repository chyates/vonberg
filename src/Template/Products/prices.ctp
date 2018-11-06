<?php 
    $this->assign('title', 'Pricing | Vonberg');
?>

<div id="prices-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="row no-gutters justify-content-lg-center justify-content-sm-between">
        <div class="col-lg-4 col-sm-6 mr-lg-3 px-lg-4">
            <?php 
                echo $this->Form->create(null, 
                    [
                        'type' => 'get',
                        'valueSources' => 'query',
                        'url' => ['controller' => 'Products', 'action' => 'prices']
                    ]);
            ?>
            <?php $this->Form->unlockField('q');?>
            <?php $this->Form->unlockField('seriesID');?>
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
        <?php if(!empty($prices)) {  
                if(file_exists('img/parts/'. $prices[0]['partID'] .'/product_image.jpg')) { ?>
                    <img class="img-fluid" src="<?= "/img/parts/".$prices[0]['partID'] ."/product_image.jpg"; ?>" alt="product-map">
        <?php } elseif(file_exists('img/parts/'. $prices[0]['partID'] .'/schematic_drawing.jpg')) { ?>
                    <img class="img-fluid" src="<?= "/img/parts/".$prices[0]['partID'] ."/schematic_drawing.jpg"; ?>" alt="product-map">
        <?php }
         } else { ?>
            <img class="img-fluid" src="/img/product-prices-image@2x-min.png" alt="product-map">
      <?php  } ?>
        </div>
    </div>

    <div class="series-model-table-row row no-gutters mx-lg-5 px-lg-5 my-3">
        <div class="table-responsive col-lg-10 col-12 mx-auto">
            <table class="model-table table">
                <?php 
                    if(!empty($prices)): 
                ?>
                    <thead>
                        <th class="model-table-header">Model</th>
                        <th class="model-table-header">Series</th>
                        <th class="model-table-header">Style</th>
                        <th class="model-table-header">Connections</th>
                        <th class="model-table-header prices-last">Base Price</th>
                    </thead>
                    
                <?php foreach($prices as $price) { ?>
                    <tbody>
                        <tr>
                            <td class="model-table-data"><?php echo $price['model_text']; ?></td>
                            <td class="model-table-data"><?php echo $price['series']; ?></td>
                            <td class="model-table-data"><?php echo $price['style']; ?></td>
                            <td class="model-table-data"><?php echo $price['conn']; ?></td>
                            <td class="prices-last model-table-data"><?php echo money_format('$%.2n', $price['unit_price']); ?></td>
                        </tr>
                    </tbody>
                <?php 
                    } elseif(isset($no_series)):
                ?>
                <thead>
                    <th class="model-table-header">Model</th>
                    <th class="model-table-header">Description</th>
                    <th class="prices-last model-table-header">Base Price</th>
                </thead>
                
                <?php
                    foreach($no_series as $item):
                ?>
                <tbody>
                    <tr>
                        <td class="model-table-data"><?php echo $item['model_text']; ?></td>
                        <?php if(!empty($item->description)) { ?>
                            <td class="model-table-data"><?php echo $item['description']; ?></td>
                        <?php } else { ?>
                            <td class="model-table-data">N/A</td>
                        <?php } ?>
                        <td class="prices-last model-table-data"><?php echo money_format('$%.2n', $item['unit_price']); ?></td>
                    </tr>
                </tbody>
                <?php
                    endforeach;
                    elseif(!empty($empty_prices)):
                        foreach($empty_prices as $each) {
                            $c_count = 0;
                            foreach($each->model_table->model_table_headers as $head_empty) {
                                $c_count++;
                            }
                            
                            $r_count = 1;
                            $model_nums = [];
                            foreach($each->model_table->model_table_rows as $empty) {
                                if($r_count >= $c_count) {
                                    $r_count = 0;
                                }
                                if($r_count == 1) {
                                    array_push($model_nums, $empty->model_table_row_text);
                                }
                                $r_count++;
                            }
                ?>
                    <thead>
                        <th class="model-table-header">Model</th>
                        <th class="model-table-header">Series</th>
                        <th class="model-table-header">Style</th>
                        <th class="model-table-header">Connections</th>
                        <th class="model-table-header prices-last">Base Price</th>
                    </thead>
                    

                    <?php for($i = 0; $i < count($model_nums); $i++) { ?>
                    <tbody>
                        <tr>
                            <td class="model-table-data"><?php echo $model_nums[$i]; ?></td>
                            <td class="model-table-data"><?php echo $each->series->name; ?></td>
                            <td class="model-table-data"><?php echo $each->style->name; ?></td>
                            <td class="model-table-data"><?php echo $each->connection->name; ?></td>
                            <td class="prices-last model-table-data"><?php echo "PLEASE CALL FOR<br>CURRENT PRICING"; ?></td>
                        </tr>
                    </tbody>
         <?php } }endif; ?>
            </table>
        </div>
    </div><!-- .series-model-table end -->

    <!-- Mobile model table/dropdowns -->
    <div id="mob-prices-tables" class="col-12 my-3">
        <?php if(!empty($prices)) {
            foreach($prices as $mob_price): 
        ?>
            <div class="row no-gutters">
                <div class="col-4">
                    <p class="top-data model-table-header">Model</p>
                    <div class="mob-hidden">
                        <p class="model-table-header">Description</p>
                        <p class="model-table-header">Style</p>
                        <p class="model-table-header">Connections</p>
                        <p class="model-table-header">Base Price</p>
                    </div>
                </div>
                <div class="col-8">
                    <p class="top-data model-table-data"><?php echo $mob_price['model_text']; ?>
                        <a class="drop-toggle" href="">View More</a>
                        <span class="">
                            <img class="mob-arrow img-fluid" src="/img/Arrow-Down.svg"/>
                        </span>
                    </p>
                    <div class="mob-hidden">
                        <p class="model-table-data"><?php echo $mob_price['series']; ?></p>
                        <p class="model-table-data"><?php echo $mob_price['style']?></p>
                        <p class="model-table-data"><?php echo $mob_price['conn']; ?></p>
                        <p class="model-table-data"><?php echo money_format('$%.2n', $mob_price['unit_price']); ?></p>
                    </div>
                </div>
            </div>
        <?php 
            endforeach; 
        } else if(isset($no_series)) { 
            foreach($no_series as $mob_item): 
        ?>
            <div class="row no-gutters">
                <div class="col-4">
                    <p class="top-data model-table-header">Model</p>
                    <div class="mob-hidden">
                        <p class="model-table-header">Description</p>
                        <p class="model-table-header">Base Price</p>
                    </div>
                </div>
                <div class="col-8">
                    <p class="top-data model-table-data"><?php echo $mob_item['model_text']; ?>
                        <a class="drop-toggle" href="">View More</a>
                        <span class="">
                            <img class="mob-arrow img-fluid" src="/img/Arrow-Down.svg"/>
                        </span>
                    </p>
                    <div class="mob-hidden">
                        <p class="model-table-data"><?php echo $mob_item['description']; ?></p>
                        <p class="model-table-data"><?php echo money_format('$%.2n', $mob_item['unit_price']); ?></p>
                    </div>
                </div>
            </div>
        <?php  endforeach;
            } else if(!empty($empty_prices)) {
          foreach($empty_prices as $each_mob):
            $c_count = 0;
            foreach($each_mob->model_table->model_table_headers as $head_empty_mob) {
                $c_count++;
            }

            $r_count = 1;
            $mob_model_nums = [];
            foreach($each_mob->model_table->model_table_rows as $empty_mob) {
                if($r_count >= $c_count) {
                    $r_count = 0;
                }
                if($r_count == 1) {
                    array_push($mob_model_nums, $empty_mob->model_table_row_text);
                }
                $r_count++;
            }
        for($j = 0; $j < count($mob_model_nums); $j++) { ?>
            <div class="row no-gutters">
                <div class="col-4">
                    <p class="top-data model-table-header">Model</p>
                    <div class="mob-hidden">
                        <p class="model-table-header">Description</p>
                        <p class="model-table-header">Style</p>
                        <p class="model-table-header">Connections</p>
                        <p class="model-table-header">Base Price</p>
                    </div>
                </div>

                <div class="col-8">
                    <p class="top-data model-table-data"><?php echo $mob_model_nums[$j]; ?>
                        <a class="drop-toggle" href="">View More</a>
                        <span class="">
                            <img class="mob-arrow img-fluid" src="/img/Arrow-Down.svg"/>
                        </span>
                    </p>
                    <div class="mob-hidden">
                        <p class="model-table-data"><?php echo $each_mob->series->name; ?></p>
                        <p class="model-table-data"><?php echo $each_mob->style->name?></p>
                        <p class="model-table-data"><?php echo $each_mob->connection->name; ?></p>
                        <p class="model-table-data"><?php echo "PLEASE CALL FOR CURRENT PRICING"; ?></p>
                    </div>
                </div>

            </div>
        <?php }
            endforeach;
        }
        ?>
    </div>

    <div class="row no-gutters">
        <div class="col-sm-6 mx-auto">
            <p class="text-center mb-sm-5"><a href="/contact">Contact us</a> for quantity discounts!</p>
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

<script>
    jQuery(document).ready(function($) {
        $("a.drop-toggle").click(function(e) {
            e.preventDefault();
            var eachClass = $(this).closest("p.model-table-data").next(".mob-hidden").attr("class");
            var res = eachClass.replace(' ', '.');
            var leftDiv = $(this).closest(".col-8").prev(".col-4").find("div").filter('.' + res);
            if(leftDiv.css('display') == "none") {
                $(this).closest("p.model-table-data").next('.mob-hidden').show();
                leftDiv.show();
                $(this).text("View Less");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Up.svg');
            } else {
                $(this).closest("p.model-table-data").next('.mob-hidden').hide();
                leftDiv.hide();
                $(this).text("View More");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Down.svg');
            }
        });
    })
</script>