<div id="category-main-container" class="col-10 mx-auto">
    <div class="prod-category-header-row row mx-5">
        <div class="col-lg-7 my-5 my-auto">
            <h1 class="page-title"><?= h($category->name) ?></h1>
            <p class="product-info"><?php echo $category->description; ?> </p>
        </div>
        <div class="col-lg-5 my-5">
            <img class="product-img-block img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png" alt="product-map">
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
            echo'<div class="prod-category-main row mx-5">
               <div class="col-lg">
               <h1 class="page-header">';
                    echo $part->type->name;
          echo '</h1>
                </div>
                </div>
          <div class="prod-category-main row mx-5">';
        } ?>
            <div class="col-lg-4 my-3">

                <A HREF=<?= "/products/view/".$part->partID; ?>>
                <img class="product-img-block img-fluid" src="http://www.scott-sherwood.com/wp-content/uploads/2011/10/TutorialFinal.png" alt="product-map">
                <div class="product-text-block my-3">
                    <h3 class="product-name"><?= h($part->series->name) ?></h3>
                    <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                </div>
                </A>
            </div>
        <?php
            if(++$counter % 3 === 0) {
                    echo '</div><div class="prod-category-main row mx-5">';
            }
            $typecount = $part->typeID;
        endforeach; ?>

    </div><!-- single-product-main-row end, 2 -->
</div><!-- single-main-container end -->
