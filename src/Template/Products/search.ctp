<div id="new-main-container" class="col-10 mx-auto">
    <div class="row no-gutters">
        <div class="col-10 mx-auto my-5">
            <h1 class="page-title">Search Results</h1>

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
          <div class="row">';
                  } ?>
                <div class="col-lg-4">
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
                    echo '</div><div class="row">';
                }
                $typecount = $part->typeID;
            endforeach; ?>

        </div><!-- single-product-main-row end, 2 -->

    </div>
</div><!-- new-main-container end -->