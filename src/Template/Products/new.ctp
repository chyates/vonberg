<div id="search-main-container" class="inner-main col-lg-10 col-12 mx-auto">
    <div class="row no-gutters">
        <div class="col-lg-10 col-12 mx-auto my-lg-5 my-3">
            <h1 class="page-title">New Products</h1>
            <?php
                $typecount=0;
                foreach ($parts as $part):
                    if ($typecount<>$part->typeID) {
                        if ($typecount<>0) {
                            echo '</div>';
                        }
                        $col_id = 1;
                    echo'<div class="prod-category-main row mt-4">
                       <div class="col-lg">
                       <h2 class="category-title">' .
                       '<a href='. '"/products/type/' . $part->typeID .'">';
                       if(!empty($part->type->name)) {
                           echo $part->type->name;
                       } elseif(empty($part->type->name) || $part->typeID == "0") {
                           echo "No type";
                       }
                  echo '</a>
                        </h2>
                        </div>
                        </div>
                  <div class="prod-category-main row mt-4">';
                } 
            ?>
                <div class="col-sm-4">
                    <A HREF=<?= "/products/view/".$part->partID; ?>>
                    <?php 
                        if(!empty($part->category->name)) {
                            if (file_exists('img/parts/'.$part->partID.'/thumbnail.jpg')) { ?>
                            <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/thumbnail.jpg"; ?>"/>
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
                    } elseif(empty($part->category->name) || $part->categoryID == "0") {
                        echo "<h3 class='empty-data'>No category</h3>";
                    }  
                    ?>
                        <div class="product-text-block my-3">
                            <h3 class="product-name">
                                <?php
                                    if(!empty($part->series->name)) {
                                        echo $part->series->name;
                                    } elseif(empty($part->series->name) || $part->seriesID == "0") {
                                        echo "No series";
                                    } 
                                ?>
                            </h3>
                            <?php if((empty($part->style->name) || $part->styleID == "0") && (empty($part->connection->name) || $part->connectionID == "0")) { ?>
                                    <p class="product-info"><?php echo "No style or connection"; ?></p>
                            <?php } else if(!empty($part->style->name) && (empty($part->connection->name) || $part->connectionID == "0")) { ?>
                                        <p class="product-info"><?php echo h($part->style->name) . " • No connection"; ?></p> 
                            <?php   } else if(!empty($part->connection->name) && (empty($part->style->name) || $part->styleID == "0")) { ?>
                                        <p class="product-info"><?php echo "No style • " . h($part->connection->name); ?></p>
                            <?php    
                                } else { ?>
                                    <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                            <?php } ?>
                        </div>
                    </A>
                </div>
                <?php
                $typecount = $part->typeID;
            endforeach; 
            ?>

        </div><!-- single-product-main-row end, 2 -->
        </div>
    </div>
</div><!-- new-main-container end -->