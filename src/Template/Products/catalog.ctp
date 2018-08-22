<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<?php
    if ($category->name === "Pressure Controls") {
        $this->assign('keywords', $this->Html->meta(
            'keywords',
            'Vonberg Hydraulic Innovation, Hydraulic valve, cartridge style valves, integrated manifolds, hydraulic valve specialists, cartridge bodies, hydraulic innovation, pressure controls, relief valves, counterbalance valves'
        ));
        $this->assign('description', $this->Html->meta('description', 'Find the right pressure controls for your next project. Vonberg designs and manufactures pressure controls, relief valves and counterbalance valves with the ultimate in flow and pressure control.')); 
    } else if ($category->name == "Flow Regulating Valves") { 
        $this->assign('keywords', $this->Html->meta(
            'keywords',
            'Vonberg Hydraulic Innovation, Hydraulic valve, cartridge style valves, integrated manifolds, hydraulic valve specialists, cartridge bodies, hydraulic innovation'
        ));
        $this->assign('description', $this->Html->meta('description', 'View Vonberg’s full product line of flow regulating valves. Vonberg flow regulating valves are pressure compensated, providing a regulated flow across a specified pressure range. They are available with our exclusive Surges Internally Dampened (S.I.D) feature designed to eliminate instability inherent in most load lowering applications.')); 
    } else if ($category->name == "Directional Valves") { 
        $this->assign('keywords', $this->Html->meta(
            'keywords',
            'Vonberg Hydraulic Innovation, Hydraulic valve, cartridge style valves, integrated manifolds, hydraulic valve specialists, cartridge bodies, hydraulic innovation, directional valves,
            Check valves, Shuttle valves'
        ));
        $this->assign('description', $this->Html->meta('description', 'Browse our complete range of Vonberg directional valves. Choose from check valves, shuttle valves and three-position spool type shuttle valves for specific applications.')); 
    } else if ($category->name == "Safety Valves") { 
        $this->assign('keywords', $this->Html->meta(
            'keywords',
            'Vonberg Hydraulic Innovation, Hydraulic valve, cartridge style valves, integrated manifolds, hydraulic valve specialists, cartridge bodies, hydraulic innovation, Safety valves, velocity fuses, flow limiters'
        ));
        $this->assign('description', $this->Html->meta('description', 'See our collection of innovative safety valves, including velocity fuses and flow limiter options. All products are created by Vonberg’s skilled engineers using the latest technology. ')); 
    } else if ($category->name == "Cartridge Bodies") { 
        $this->assign('keywords', $this->Html->meta(
            'keywords',
            'Vonberg Hydraulic Innovation, Hydraulic valve, cartridge style valves, integrated manifolds, hydraulic valve specialists, cartridge bodies, hydraulic innovation'
        ));
        $this->assign('description', $this->Html->meta('description', 'View the entire Vonberg product line of cartridge bodies. Our cartridge bodies are available with either industry standard or T-series cavities and a variety of port types and sizes. Cartridge bodies can be ordered individually or as an assembly that includes the Vonberg cartridge valve. ')); 
    }
    $this->assign('title', $category->name . ' | Hydraulic Innovation');
?>

<div id="category-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="prod-category-header-row row mx-lg-5">
        <div class="col-md-7 col-12 my-lg-auto">
            <h1 class="page-title"><?= h($category->name) ?></h1>
            <p class="product-info"><?php echo $category->description; ?> </p>
        </div>
        <div class="col-sm-5 my-lg-auto">
            <?php
            if($category->name == "Pressure Controls") { ?>
                <img class="img-fluid" src="/img/Pressure-Controls@2.png" alt="product-map">
                <?php } else if ($category->name == "Flow Regulating Valves") { ?>
                <img class="img-fluid" src="/img/Flow-Regulating-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Directional Valves") { ?>
                    <img class="img-fluid" src="/img/Directional-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Safety Valves") { ?>
                    <img class="img-fluid" src="/img/Safety-Valves@2.png" alt="product-map">
                <?php } else if ($category->name == "Cartridge Bodies") { ?>
                    <img class="img-fluid" src="/img/Cartiridge-Bodies@2.png" alt="product-map">
               <?php } ?>
        </div>
    </div><!-- single-product-header-row end -->

    <?php
        $counter=0;
        $typecount=0;
        $col_id = 1;
        foreach ($parts as $part):
            if ($typecount<>$part->typeID) {
                if ($typecount<>0) {
                    echo '</div>';
                }
                $col_id = 1;
            echo'<div class="prod-category-main row mx-lg-5 mt-4">
               <div class="col-lg">
               <h2 class="category-title">' .
               '<a href='. '"/products/type/' . $part->typeID .'">';
                    echo $part->type->name;
          echo '</a>
                </h2>
                </div>
                </div>
          <div class="prod-category-main row mx-lg-5">';
        } 
        ?>
            <div id="<?= $col_id; ?>" class="col-md-4 col-6 my-md-3">
                <a href=<?= "/products/view/".$part->partID; ?>>
                    <?php if (file_exists('img/parts/'.$part->partID.'/product_image.jpg')) { ?>
                    <div class="product-img-block-container">
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/product_image.jpg"; ?>"/>
                    </div>
                    <?php } else if (file_exists('img/parts/'.$part->partID.'/schematic_drawing.jpg')) { ?>
                    <div class="product-img-block-container">
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>"/>
                    </div>
                    <?php } else { ?>
                        <div class="product-img-block-container">
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
                        ?>
                        </div>
                    <?php }  ?>
                    <div class="product-text-block mt-lg-3 mt-sm-5 mb-sm-0 mb-4">
                        <h3 class="product-name"><?= h($part->series->name) ?></h3>
                        <?php if(empty($part->style->name) && empty($part->connection->name)) { ?>
                            <p class="product-info"><?php echo "No style or connection"; ?></p>
                        <?php } else if(!empty($part->style->name) && empty($part->connection->name)) { ?>
                            <p class="product-info"><?php echo h($part->style->name) . " • No connection"; ?></p> 
                        <?php } else if(!empty($part->connection->name) && empty($part->style->name)) { ?>
                            <p class="product-info"><?php echo "No style • " . h($part->connection->name); ?></p>
                        <?php } else { ?>
                            <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                        <?php } ?>
                    </div>
                </a>
            </div>
        <?php
            $col_id++;
            $typecount = $part->typeID;
        endforeach; ?>
    </div><!-- single-product-main-row end, 2 -->
</div><!-- single-main-container end -->

<script type="text/javascript">
    jQuery(document).ready(function($) {
        var cols = $(".prod-category-main.row").find(".col-6");
        $(cols).each(function(index) {
            var id = parseInt($(this).attr('id'));
            if(id > 3) {
                $(this).addClass('needs-border');
            }
        })
    })
</script>