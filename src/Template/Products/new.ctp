<div id="search-main-container" class="inner-main col-lg-10 col-12 mx-auto">
    <div class="row no-gutters">
        <div class="col-lg-10 col-12 mx-auto my-lg-5 my-3">
            <h1 class="page-title">New Products</h1>
            <?php
            $counter=0;
            $typecount=0;
            foreach ($parts as $part):
                if ($typecount<>$part->typeID) {
                    if ($typecount<>0) {
                        echo '</div>';
                    }
                    echo'<h1 class="page-header my-4">';
                    if($part->type->name) {
                        echo $part->type->name;
                    } else {
                        echo "No type";
                    }
                    echo '</h1>
                        <div class="row no-gutters">';
                  } ?>
                <div class="col-sm-4">
                    <?php 
                        if(!empty($part->category->name)) {
                            if (file_exists('img/parts/'.$part->partID.'/product_image.jpg')) { ?>
                            <A HREF=<?= "/products/view/".$part->partID; ?>>
                            <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."product_image.jpg"; ?>"/>
                    <?php } else { ?>
                        <?php if($part->category->name == "Pressure Controls") { ?>
                            <img class="product-img-block img-fluid" src="/img/Pressure-Controls@2.png" alt="product-map">
                        <?php } else if ($part->category->name == "Flow Regulating Valves") { ?>
                            <img class="product-img-block img-fluid" src="/img/Flow-Regulating-Valves@2.png" alt="product-map">
                        <?php } else if ($part->category->name == "Directional Valves") { ?>
                            <img class="product-img-block img-fluid" src="/img/Directional-Valves@2.png" alt="product-map">
                        <?php } else if ($part->category->name == "Safety Valves") { ?>
                            <img class="product-img-block img-fluid" src="/img/Safety-Valves@2.png" alt="product-map">
                        <?php } else if ($part->category->name == "Cartridge Bodies") { ?>
                            <img class="product-img-block img-fluid" src="/img/Cartiridge-Bodies@2.png" alt="product-map">
                        <?php 
                            } 
                        }
                    } else {
                        echo "<h3 class='empty-data'>No category</h3>";
                    }  
                    ?>
                        <div class="product-text-block my-3">
                            <h3 class="product-name"><?= h($part->series->name) ?></h3>
                            <?php if(empty($part->style->name) && empty($part->connection->name)) { ?>
                                    <p class="product-info"><?php echo "No style or connection"; ?></p>
                            <?php } else if(!empty($part->style->name) && empty($part->connection->name)) { ?>
                                        <p class="product-info"><?php echo h($part->style->name) . " • No connection"; ?></p> 
                            <?php   } else if(!empty($part->connection->name) && empty($part->style->name)) { ?>
                                        <p class="product-info"><?php echo "No style • " . h($part->connection->name); ?></p>
                            <?php    
                                } else { ?>
                                    <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                            <?php } ?>
                        </div>
                    </A>
                </div>
                <?php
                if(++$counter % 3 === 0) {
                    echo '</div><div class="row no-gutters">';
                }
                $typecount = $part->typeID;
            endforeach; 
            ?>

        </div><!-- single-product-main-row end, 2 -->
        </div>
    </div>
</div><!-- new-main-container end -->