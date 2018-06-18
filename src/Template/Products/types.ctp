<div id="subcat-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="prod-subcat-main row mx-lg-5">
        <div class="col-lg">
            <h1 class="page-header">Testing</h1>
        </div>
    </div>
    <?php

        $counter=0;
        $typecount=0;
        foreach ($parts as $part): ?>
          <!--<div class="prod-category-main row mx-lg-5">-->
            <div class="col-md-4 col-6 my-3">
                <a href=<?= "/products/view/".$part->partID; ?>>
                    <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>" alt="product-map">
                    <div class="product-text-block my-3">
                        <h3 class="product-name"><?= $part->series->name ?></h3>
                        <p class="product-info"><?= $part->style->name ?> • <?= $part->connection->name ?></p>
                    </div>
                </a>
            </div>
        <?php $typecount = $part->typeID;
        endforeach; ?>
</div>
