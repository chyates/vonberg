<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<div id="subcat-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <h1 class="page-title"><?= h($types->name) ?></h1>

    <?php
        $counter=0;
        $typecount=0;
        $col_id = 1;
        echo'<div class="prod-category-main row mx-lg-5">';
        foreach ($parts as $part):
         ?>
            <div id="<?= $col_id; ?>" class="col-md-4 col-6 my-md-3">
                <a href=<?= "/products/view/".$part->partID; ?>>
                    <?php if(file_exists('img/parts/'.$part->partID.'/thumbnail.jpg')) { ?>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/thumbnail.jpg"; ?>"/>
                    <?php } else if (file_exists('img/parts/'.$part->partID.'/schematic_drawing.jpg')){ ?>
                        <img class="product-img-block img-fluid" src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>"/>
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
                        ?>
                    <div class="product-text-block mt-lg-3 mt-sm-5 mb-sm-0 mb-4">
                        <h3 class="product-name"><?= h($part->series->name) ?></h3>
                        <?php if(empty($part->style->name) && empty($part->connection->name)) { ?>
                        <p class="product-info"><?php echo "No style or connection"; ?></p>
                        <?php } else if(!empty($part->style->name) && empty($part->connection->name)) { ?>
                            <p class="product-info"><?php echo h($part->style->name) . " • No connection"; ?></p> 
                        <?php   } else if(!empty($part->connection->name) && empty($part->style->name)) { ?>
                            <p class="product-info"><?php echo "No style • " . h($part->connection->name); ?></p>
                        <?php    
                            } else { ?>
                            <p class="product-info"><?= h($part->style->name) ?> • <?= h($part->connection->name) ?></p>
                        <?php } ?>
                    </div>
                </a>
            </div>
        <?php
            $col_id++;
            $typecount = $part->typeID;
        endforeach; 
        ?>
    </div>
</div>

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