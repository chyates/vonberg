<div id="search-main-container" class="inner-main col-lg-10 col-12 mx-auto">
    <div class="row no-gutters">
        <div class="col-lg-10 col-12 mx-auto my-lg-5 my-3">
            <h1 class="page-title">Latest Products</h1>
            <?php
            $counter=0;
            $typecount=0;
            foreach ($parts as $part):
                if ($typecount<>$part->typeID) {
                    if ($typecount<>0) {
                        echo '</div>';
                    }
                    echo'<h1 class="page-header my-4">';
                    echo $part->type->name;
                    echo '</h1>
          <div class="row no-gutters">';
                  } ?>
                <div class="col-sm-4">
                    <A HREF=<?= "/products/view/".$part->partID; ?>>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>" alt="product-map">
                        <div class="product-text-block my-3">
                            <h3 class="product-name"><?= h($part->series->name) ?></h3>
                            <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                        </div>
                    </A>
                </div>
                <?php
                if(++$counter % 3 === 0) {
                    echo '</div><div class="row no-gutters">';
                }
                $typecount = $part->typeID;
            endforeach; ?>

        </div><!-- single-product-main-row end, 2 -->
        </div>
    </div>
</div><!-- new-main-container end -->