<div id="category-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="prod-category-header-row row mx-lg-5">
        <div class="col-sm-7 col-12 my-lg-auto">
            <h1 class="page-title"><?= h($category->name) ?></h1>
            <p class="product-info"><?php echo $category->description; ?> </p>
        </div>
        <div class="col-sm-5 my-lg-auto">
            <?php
            if($category->name == "Pressure Controls") { ?>
                <img class="product-img-block img-fluid" src="/img/Pressure-Controls@2.png" alt="product-map">
                <?php } else if ($category->name == "Flow Regulating Valves") { ?>
                <img class="product-img-block img-fluid" src="/img/Flow-Regulating-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Directional Valves") { ?>
                    <img class="product-img-block img-fluid" src="/img/Directional-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Safety Valves") { ?>
                    <img class="product-img-block img-fluid" src="/img/Safety-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Cartridge Bodies") { ?>
                    <img class="product-img-block img-fluid" src="/img/Cartiridge-Bodies@2.png" alt="product-map">
               <?php } ?>
        </div>
    </div><!-- single-product-header-row end -->

    <?php
        $counter=0;
        $typecount=0;
        foreach ($parts as $part):
        if ($typecount<>$part->typeID) {
            if ($typecount<>0) {
                echo '</div>';
            }
            echo'<div class="prod-category-main row mx-lg-5">
               <div class="col-lg">
               <h2 class="category-title">' .
               '<a href='. '"/products/types/' . str_replace(' ', '-', strtolower($part->type->name)) .'">';
                    echo $part->type->name;
          echo '</a>
                </h2>
                </div>
                </div>
          <div class="prod-category-main row mx-lg-5">';
        } ?>
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

    </div><!-- single-product-main-row end, 2 -->
</div><!-- single-main-container end -->
