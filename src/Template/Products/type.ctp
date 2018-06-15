<div id="subcat-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <h1 class="page-title"><?= h($types->name) ?></h1>

    <?php
        $counter=0;
        $typecount=0;
    echo'<div class="prod-category-main row mx-lg-5">';
        foreach ($parts as $part):
         ?>
            <div class="col-md-4 col-6 my-3">

                <A HREF=<?= "/products/view/".$part->partID; ?>>
                <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>" alt="product-map">
                <div class="product-text-block my-3">
                    <h3 class="product-name"><?= h($part->series->name) ?></h3>
                    <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                </div>
                </A>
            </div>
        <?php

            $typecount = $part->typeID;
        endforeach; ?>

    </div>
</div>
