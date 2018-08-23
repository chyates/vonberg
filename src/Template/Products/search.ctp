<div id="search-main-container" class="inner-main col-lg-10 col-12 mx-auto">
    <div class="row no-gutters">
        <div class="col-lg-10 col-12 mx-auto my-lg-5 my-3">
            <h1 class="page-title">Search Results</h1>
            <?php
                if(count($parts) >= 1):
                    $counter=0;
                    $typecount=0;
                    $col_id = 1;
                    foreach ($parts as $part):
                        if ($typecount<>$part->typeID) {
                            if ($typecount<>0) {
                                $col_id = 1;
                                echo '</div>';
                            }
                            echo'<h1 class="page-header my-4">';
                            echo '<a href="/products/type/' . $part->typeID . '">';
                            if(!empty($part->type->name)) {
                                echo $part->type->name;
                            } elseif(empty($part->type->name) || $part->typeID == "0") {
                                echo "No type";
                            }
                            echo '</a></h1>
                            <div class="row no-gutters">';
                        } 
            ?>
                <div id="<?= $col_id; ?>" class="col-sm-4">
                    <a href=<?= "/products/view/".$part->partID; ?>>
                    <?php if (file_exists('img/parts/'.$part->partID.'/thumbnail.jpg')) { ?>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/thumbnail.jpg" ?>" alt="product-map">
                    <?php } elseif(file_exists('img/parts/'.$part->partID.'/schematic_drawing.jpg')) { ?>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>" alt="product-map">
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
                        } ?>
                        <div class="product-text-block my-3">
                            <h3 class="product-name"><?= h($part->series->name) ?></h3>
                            <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                        </div>
                    </a>
                </div>
            <?php
                if(++$counter % 3 === 0) {
                    echo '</div><div class="row no-gutters">';
                }
                $col_id++;
                $typecount = $part->typeID;
                endforeach;
            else: 
            ?>
            <h3 class="empty-data">No search results found, please try again.</h3>
            <?php endif; ?>
            </div><!-- single-product-main-row end, 2 -->
        </div>
    </div>
</div>