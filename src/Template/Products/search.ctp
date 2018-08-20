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
                            echo $part->type->name;
                            echo '</a></h1>
                            <div class="row no-gutters">';
                        } 
            ?>
                <div id="<?= $col_id; ?>" class="col-sm-4">
                    <a href=<?= "/products/view/".$part->partID; ?>>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>" alt="product-map">
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