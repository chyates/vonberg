<?php 
    $this->assign('title', $part->series->name .' | Vonberg');
?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- Get STP Modal -->
<div class="modal fade" id="get-stp-modal" tabindex="-1" role="dialog" aria-labelledby="stp-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img class="modal-close-icon" src="/img/X.svg" />
                    </span>
                </button>
            </div>
            <div class="modal-body col-lg-10 mx-auto">
                <?php
                    $stp_exists = false;
                    $t_width = count($part->model_table->model_table_headers);
                    $mod_count = 1;
                    foreach($part->model_table->model_table_rows as $row) {
                        if($mod_count >= $t_width) {
                            $mod_count = 0;
                        }
                        if($mod_count == 1) {
                            if(file_exists('img/parts/'.$part->partID.'/'.$row->model_table_row_text.'.stp')) {
                                $stp_exists = true;
                            }
                        }
                        $mod_count++;
                    }
                ?>
                <?php if(!$stp_exists) { ?>
                    <div id="missing-stp" class="text-center">
                    <h1 class="get-header page-header">Get STP Files</h1>
                    <p>This part doesn't have any stp files.</p>
                    <p class="mb-5">Don’t see the model you’re looking for?<a href="/contact" class="px-2">Contact us!</a></p>
                </div>
             <?php } else { ?>
                <h1 class="get-header page-header">Get STP Files</h1>
                    <?php 
                        echo $this->Form->create('get-stp-form', array(
                            'id' => 'get-stp-form',
                            'class' => 'needs-validation',
                            'novalidate',
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            )
                        )); 
                    ?>
                        <p>You will receive an email with the files attached.</p>
                        <p>Which model(s) are you interested in?*</p>
                        <?php 
                        $mobRow = 1;
                        $rowID = 1;
                        $width = sizeof($part->model_table->model_table_headers); ?>
                        <div id="check-container">
                            <?php 
                            foreach ($part->model_table->model_table_rows as $row):
                            if ($mobRow === 1) {
                                echo '<div class="form-check check-req">';
                                echo $this->Form->control('model[]', 
                                [
                                    'type' => 'checkbox', 
                                    'value'=> $row->model_table_row_text, 
                                    'class' => 'form-check-input', 
                                    'label' => 
                                        [
                                        'text' => 'Model ' . $row->model_table_row_text, 
                                        'class' => 'form-check-label'
                                        ], 
                                    'id' => $row->model_table_rowID,
                                    'hiddenField' => false
                                ]);
                                echo '</div>';
                                }
                                if ($mobRow >= $width){
                                    $mobRow=0;
                                }
                                $mobRow++;
                            endforeach;
                            ?>
                        </div>
                        <p id="check-validity" class="invalid-feedback" style="display: none;">
                            Please select at least one model file.
                        </p>
                        <p>Don’t see the model you’re looking for?<a href="/contact" class="px-2">Contact us!</a></p>

                        <?php 
                            echo $this->Form->input('part', 
                            [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'hidden form-control',
                                'id' => 'part',
                                'value' => $part->partID
                            ]);

                            echo $this->Form->control('first_name', 
                            [
                                'label' => 'First Name*',
                                'type' => 'text', 
                                'class' => 'form-control', 
                                'required'
                            ]); 
                        ?>

                        <?php 
                            echo $this->Form->control('last_name', 
                            [
                                'label' => 'Last Name*', 
                                'type' => 'text', 
                                'class' => 'form-control', 
                                'required'
                            ]); 
                        ?>

                        <?php 
                            echo $this->Form->control('company', 
                            [
                                'type' => 'text', 
                                'class' => 'form-control'
                            ]);
                        ?>

                        <?php 
                            echo $this->Form->control('email', 
                            [
                                'label' => 'Email*', 
                                'type' => 'text', 
                                'class' => 'form-control', 
                                'required'
                            ]);
                        ?>

                        <div class="form-group row no-gutters">
                            <div class="col-6 my-auto">
                                <p class="my-auto req-text text-left">*Mandatory</p>
                            </div>
                            <div class="col-6 text-right">
                                <?php
                                echo $this->Form->submit('SUBMIT',array(
                                    'id' => 'stp-submit',
                                    'class' => 'btn btn-primary'));
                                ?>
                            </div>
                        </div>
                    <?php 
                        echo $this->Form->end(); 
                    }
                    ?>
                <div id="thanks" class="thanks text-center">
                    <h1 class="page-header">Thank you!</h1>
                    <div class="modal_message"></div>
                    <p class="my-3">You will be receiving an email with the STP files shortly.</p>
                    <button type="button" class="thanks-close btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="single-prod-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5">
    <div id="single-prod-main" class="row no-gutters mx-lg-5 px-lg-3">
        <?php 
            $curr_url = $this->request->here;
            $seg = '';
            for($q = 0; $q < strlen($curr_url); $q++) {
                if($curr_url[$q] === 'w') {
                    for($x = $q + 2; $x < strlen($curr_url); $x++) {
                        $seg .= $curr_url[$x];
                    }
                }
            }
        ?>
        <div class="single-prod-left-col col-sm-7 col-12 px-lg-3">
            <div class="left-info">
                <div id="typeid" class="hidden"><?php echo $part->type->name; ?></div>
                <div id="partid" class="hidden"><?php echo $part->partID; ?></div>
                <div id="ultra-cat" hidden><?php echo $part->category->name; ?></div>
                <h1 id="seriesid" class="page-title">
                    <?php
                        if(!empty($part->series->name)) {
                            echo $part->series->name;
                        } elseif(empty($part->series->name) || $part->seriesID == "0") {
                            echo "No series";
                        } 
                    ?>
                </h1>
                <h3 id="categoryid" class="product-name"><?= h($part->type->name);?></h3>
                <?php if(empty($part->style->name) && empty($part->connection->name)) { ?>
                    <p class="product-info"><?php echo "No style or connection"; ?></p>
                <?php } else if(!empty($part->style->name) && empty($part->connection->name)) { ?>
                    <p class="product-info"><?php echo h($part->style->name) . " • No connection"; ?></p> 
                <?php } else if(!empty($part->connection->name) && empty($part->style->name)) { ?>
                    <p class="product-info"><?php echo "No style • " . h($part->connection->name); ?></p>
                <?php } else { ?>
                    <p class="product-info">
                        <span id="styleid"><?= h($part->style->name) ?></span> • 
                        <span id="connectionid"><?= h($part->connection->name) ?></span>
                    </p>
                <?php } ?>
            </div>

            <div class="left-desc mt-sm-3">
                <h3 class="product-name">Description</h3>
                <p id="description" class="product-info">
                    <?php 
                        if(!empty($part->description)) {
                            echo $part->description;
                        } else {
                            echo "No description provided";
                        } 
                    ?>
                </p>
            </div>

            <?php if (file_exists('img/parts/'.$part->partID.'/product_image.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Product Rendering</h3>
                <img id="product" class="my-3 img-fluid" src="<?= "/img/parts/".$part->partID."/product_image.jpg"; ?>"/>
            </div>
            <?php } ?>

            <?php if (file_exists('img/parts/'.$part->partID.'/schematic_drawing.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Schematic</h3>
                <img id="schematic" class="my-3 " src="<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>"/>
            </div>
            <?php } ?>

            <?php if (file_exists('img/parts/'.$part->partID.'/typical_performance.jpg')){ ?>
            <div class="left-img-div mt-sm-4">
                <h3 class="product-name">Typical Performance</h3>
                <img id="performance" class="my-3 product-performance img-fluid" src="<?= "/img/parts/".$part->partID."/typical_performance.jpg"; ?>" />
                <?php if (file_exists('img/parts/' .$part->partID. '/performance_graphs.pdf')) { ?>
                    <div>
                        <span class="pr-2">
                            <img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/>
                        </span>
                        <a target="_blank" id="performance-graphs" rel="noopener"href="<?= "/img/parts/" .$part->partID. '/performance_graphs.pdf'; ?>">Download Performance Curves Graphics</a>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div><!-- .single-prod-left-col end -->

        <div class="single-prod-right-col col-sm-5 col-12 px-lg-0 pt-4">
            <div class="right-top-links">
                <a data-toggle="modal" data-target="#get-stp-modal">Get STP File</a>
                <a href="/products/prices?q=&seriesID=<?php echo $part->seriesID; ?>">View Pricing</a>
                <a id="gen-pdf" href="">Download PDF</a>
            </div>

            <div class="right-main-content mt-sm-3 p-sm-4">
                <?php
                    $typecount='';
                    echo '<div>';
                    foreach ($part->text_blocks as $block):
                        if ($typecount <> $block->header) {
                            if ($typecount <> '') {
                                echo '</div>';
                            }
                            echo '<h3 class="product-name">';
                            echo $block->header;
                            echo '</h3>
                        <ul id="' . strtolower($block->header) . '" class="right-list px-3">';
                        } 
                        foreach ($block->text_block_bullets as $bullet):
                            echo '<li class="mt-2 pl-3">' . $bullet->bullet_text . '</li>';
                        endforeach; 
                        $typecount = $block->header;
                    endforeach;
                    echo '</ul>'; 
                ?>

                <div hidden><?php print_r($part->text_blocks); ?></div>

                <h3 class="product-name">Specifications</h3>
                <div class="spec-table table-sm">
                    <table class="specifications table">
                    <?php 
                        foreach ($part->specifications as $spec): 
                    ?>
                        <tr>
                            <th><?php echo $spec->spec_name;?></th>
                            <td><?php echo $spec->spec_value;?></td>
                        </tr>
                    <?php 
                        endforeach;  
                    ?>
                    </table>
                </div>
            </div>

            <div class="right-col-bottom">
                <h3 class="product-name">Ordering Information</h3>
                <?php if (file_exists('img/parts/'.$part->partID.'/ordering_information.jpg')){ ?>
                    <img id="ordering" class="product-order img-fluid" src="<?= "/img/parts/".$part->partID."/ordering_information.jpg"; ?>"/>
                <?php } ?>
            </div>

        </div><!-- .single-prod-right-col end -->
    </div><!-- #single-prod-main end -->

    <div class="series-model-table-row row no-gutters mx-lg-5 px-lg-3">
        <div class="table-responsive">
            <table id="prod-mt" class="model-table table">
                <thead>
                <?php 
                    $columns = 0;
                    $count = 1;

                    foreach ($part->model_table->model_table_headers as $header): 
                        echo '<th id="' . $count . "-" . ($columns+1) .'" class="mt-pdf model-table-header">' . $header->model_table_text . '</th>';
                        $columns++;
                    endforeach; 
                ?>
                </thead>

                <tbody>
                <tr>
                    <?php 
                        $mobCount = 0;
                        $r_columns = 1;
                        $last_space = 0;
                        $w_ds = " /";

                        foreach ($part->model_table->model_table_rows as $row):                            
                            if(strpos($row->model_table_row_text, $w_ds) !== false) {
                                $last_space = strpos($row->model_table_row_text, $w_ds);
                                $up_text = substr_replace($row->model_table_row_text, "<br>", $last_space+2, 0);
                            }
                            
                            if(!empty($up_text)) {
                                echo '<td id="' . ($r_columns+1) . "-" . $count . '"class="mt-pdf model-table-data">'.$up_text.'</td>';
                                $up_text = NULL;
                            } else if(!empty($row->model_table_row_text)){
                                echo '<td id="' . ($r_columns+1) . "-" . $count . '"class="mt-pdf model-table-data">'.$row->model_table_row_text.'</td>';
                            }
                            if ($count >= $columns){
                                echo '</tr>';
                                $count = 0;
                                $r_columns++;
                            }
                            $count++;
                            $mobCount++;
                        endforeach;
                    ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!-- .series-model-table end -->

    <!-- Mobile model table/dropdowns -->
    <div id="mob-model-tables" class="col-12">
        <div class="row no-gutters pt-4 pb-3">
                <div class="col-5">
                    <?php $mobHead = 1;
                        $divID = 1;
                        for($i = 0; $i <= ($mobCount/$columns)-1; $i++) {
                            foreach ($part->model_table->model_table_headers as $header):
                                if($mobHead === 2) {
                                    echo '<div class="mob-hidden ' . strval($divID) . '">';
                                } if($mobHead === 1) { ?>
                                <p class="top-data model-table-header"><?php echo $header->model_table_text; ?></p>
                        <?php
                                } else { 
                        ?>
                                <p class="model-table-header"><?php echo $header->model_table_text; ?></p>
                        <?php 
                            } if ($mobHead >= $columns) {
                                echo '</div>';
                                $mobHead=0;
                            }
                            $mobHead++;
                            endforeach; 
                        $divID++;
                            } 
                    ?>
                </div>
                <div class="col-7">
                    <?php 
                        $mobRow = 1;
                        $rowID = 1;
                        foreach ($part->model_table->model_table_rows as $row):
                            if($mobRow === 2) {
                                echo '<div class="mob-hidden ' . $rowID . '">';
                                $rowID++;
                            } if ($mobRow === 1) {
                                echo '<p class="top-data model-table-data">'.$row->model_table_row_text.'<a class="drop-toggle" href="">View More</a><span class=""><img class="mob-arrow img-fluid" src="/img/Arrow-Down.svg"/></span></p>';
                            } else {
                                echo '<p class="model-table-data">'.$row->model_table_row_text.'</p>';
                            }
                            if ($mobRow >= $columns){
                                echo '</div>';
                                $mobRow=0;
                            }
                            $count++;
                            $mobRow++;
                        endforeach;
                    ?>
                </div>
        </div>
    </div>

    <div id="mob-bottom-links" class="row no-gutters">
        <div class="col text-center">
            <button class="btn btn-primary" data-toggle="modal" data-target="#get-stp-modal">Get STP File</button>
            <a class="btn btn-primary" href=<?= "/img/pdfs/catalog/" . $part->partID . ".pdf"; ?> download >Download PDF</a>
            <a class="center-link" href="/products/prices?q=&seriesID=<?php echo $part->seriesID; ?>">View Pricing</a>
        </div>
    </div>

    <div class="legalese row no-gutters mx-sm-5 px-sm-5 ;px-3 pb-sm-5 pb-3">
        <p id="lastupdated" class="legal-title mx-auto mb-1">Page last updated: <?php echo $part->last_updated;?></p>
        <p class="legal-block">This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met.</p>
        <p class="legal-block">The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of vonberg valve, inc. without prior notification.</p>
    </div> <!-- .legalese end -->
</div><!-- #single-prod-main-container end -->

<script>
    var redir = <?php echo json_encode($redirect); ?>;
    <?php if(!empty($r_check)) { ?>
        var check = <?php echo json_encode($r_check); ?>;
    <? } ?>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        var checkboxes = document.querySelectorAll('.check-req');
        var checkStatus = [];
        var showDiv = document.getElementById('check-validity');
        
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                console.log("Hit form validation function");
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    console.log("Form is invalid, check");
                }
                // loop through checkboxes to find if any have been selected
                for(var i = 0; i < checkboxes.length; i++) {
                        var divs = checkboxes[i].children;
                        for(var j = 0; j < divs.length; j++) {
                            var labels = divs[j].children;
                            for(var k = 0; k < labels.length; k++) {
                                var inputs = labels[k].children;
                                for(var m = 0; m < inputs.length; m++) {
                                    if(inputs[m].checked) {
                                        checkStatus.push(inputs[m].checked);
                                    }
                                }
                            }

                        }
                    }
                    if (checkStatus.length < 1) {
                        event.preventDefault();
                        event.stopPropagation();    
                        showDiv.style.display = 'block';
                    }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
    })();


    function getDataUri(url, callback) {
        let image = new Image()

        image.onload = function() {
            let canvas = document.createElement('canvas')
            canvas.width = this.naturalWidth
            canvas.height = this.naturalHeight

            canvas.getContext('2d').drawImage(this, 0, 0)

            callback(canvas.toDataURL('image/jpg'))
        }

        image.src = url
    }

    function titleCase(str) {
        return str.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
        })
    }

    let performance, product, ordering, schematic, oldLogo

    getDataUri('<?= "/img/parts/".$part->partID."/typical_performance.jpg"; ?>', function(dataUri) {
        performance = dataUri
    })

    getDataUri('<?= "/img/parts/".$part->partID."/product_image.jpg"; ?>', function(dataUri) {
        product = dataUri
    })

    getDataUri('<?= "/img/parts/".$part->partID."/ordering_information.jpg"; ?>', function(dataUri) {
        ordering = dataUri
    })

    getDataUri('<?= "/img/parts/".$part->partID."/schematic_drawing.jpg"; ?>', function(dataUri) {
        schematic = dataUri
    })

    getDataUri('/img/1971-logo.png', function(dataUri) {
        oldLogo = dataUri
    })
    
    document.getElementById('gen-pdf').onclick = function(e) {
        e.preventDefault()

        let ajax = new XMLHttpRequest()
        ajax.open('GET', '/img/vonberg_logo.png')
        ajax.responseType = 'arraybuffer'

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let logo = ajax.response
                
                let type = document.getElementById('typeid').innerText
                let ultraCat = document.getElementById('ultra-cat').innerText.toUpperCase()
                let category = document.getElementById('categoryid').innerText
                let style = document.getElementById('styleid').innerText
                let series = document.getElementById('seriesid').innerText
                let connection = document.getElementById('connectionid').innerText
                let description = document.getElementById('description').innerText.toUpperCase().replace(/˚/g, '\u00B0')
                let lastUpdated = document.getElementById('lastupdated').innerText
                let operation = []
                let features = []
                let specifications = []
                let seriesInputs = []
                let performanceGraphs = document.getElementById('performance-graphs') ? document.getElementById('performance-graphs').href : null

                Array.prototype.forEach.call(document.querySelectorAll('#operation li'), function(bullet) {
                    operation.push(bullet.innerText.toUpperCase().replace(/˚/g, '\u00B0'))
                })
                operation = operation.filter(function(op) {return op != ''})
                Array.prototype.forEach.call(document.querySelectorAll('#features li'), function(bullet) {
                    features.push(bullet.innerText.toUpperCase().replace(/˚/g, '\u00B0'))
                })
                features = features.filter(function(feat) {return feat != ''})
                Array.prototype.forEach.call(document.querySelectorAll('.specifications th'), function(header) {
                    specifications.push([header.innerText])
                })
                Array.prototype.forEach.call(document.querySelectorAll('.specifications td'), function(row, index) {
                    specifications[index].push(row.innerText.replace(/˚/g, '\u00B0'))
                })
                specifications = specifications.filter(function(spec) {
                    return spec.filter(function(data) {return data != ''}).length > 0
                })

                Array.prototype.forEach.call(document.querySelectorAll('#prod-mt .mt-pdf'), function(cell) {
                    let coords = cell.id.split('-')
                    seriesInputs.push({
                        row: Number(coords[0]),
                        col: Number(coords[1]),
                        val: cell.innerText.toUpperCase().replace(/˚/g, '\u00B0')
                    })
                })
                seriesInputs.sort(function(a, b) {
                    if (a.row > b.row) return 1
                    else if (a.row < b.row) return -1
                    else if (a.col > b.col) return 1
                    else if (a.col < b.col) return -1
                    else return 0 // should not happen
                })
                // group cells by row
                let totalCol = seriesInputs[seriesInputs.length - 1].col
                let seriesTable = []
                for (let i = 0; i < seriesInputs.length; i += totalCol) {
                    seriesTable.push(seriesInputs.slice(i, i + totalCol))
                }
                let slashinRows = () => {
                    let realCells = seriesTable[seriesTable.length - 1].filter(cell => cell.val)
                    if (realCells.length === 0) {
                        seriesTable.pop()
                        slashinRows()
                    }
                }
                slashinRows()
                let slashinCols = () => {
                    let realCells = seriesTable.map(row => row[row.length - 1]).filter(cell => cell.val)
                    if (realCells.length === 0) {
                        seriesTable.forEach(row => row.pop())
                        slashinCols()
                    }
                }
                slashinCols()
                totalCol = seriesTable.length

                let doc = new PDFDocument({autoFirstPage: false})
                stream = doc.pipe(blobStream())
                doc.addPage({
                    margin: 15
                })

                doc.info.Title = type
                doc.info.Author = 'Vonberg Valve, inc.'

                // console.log(doc)
                const docWidth = 612
                const docHeight = 792

                let totalPages = 1
                let currentPage = 1 // yes i'm starting from 1 not 0 don't judge me

                function wrangleImages(index) {
                    let images = Object.keys(doc._imageRegistry).map(key => (doc._imageRegistry[key]))
                    if (index) return index == -1 ? images[images.length - 1] : images[index]
                    else return images
                }
                function getImageHeight(image, width) {
                    let ratio = image.height / image.width
                    return Math.ceil(ratio * width)
                }
                
                function header() {
                    doc.image(logo, 10, 10, {
                        height: 60
                    })
                    
                    doc.fillColor('#00703c')
                    doc.font('Helvetica-Bold')
                    doc.fontSize(16)

                    if(type.length > 25) {
                        var lastSpace = 0;
                        for(var i = type.length-1; i > 0; i--) {
                            if(type[i] == " ") {
                                lastSpace = i+1
                                break
                            }
                        }

                        let addl = type.slice(lastSpace)
                        type = type.slice(0, lastSpace)
                        doc.text(type, 0, 35, {
                            align: 'center'
                        })  
                        doc.text(addl, 0, 50, { 
                            align: 'center'
                        })
                    } else {
                        doc.text(type, 0, 35, {
                            align: 'center'
                        })  
                    }

                    // default line height for 12px font is 14.4, rounding up to 15
                    doc.fontSize(12)
                    doc.text(ultraCat, 0, 15, {
                        align: 'right'
                    })
                    doc.text(style, 0, 30, {
                        align: 'right'
                    })
                    doc.fillColor('#000000')
                    doc.fontSize(10)
                    doc.text(series, 0, 45, {
                        align: 'right'
                    })
                    doc.text(connection, 0, 60, {
                        align: 'right'
                    })

                    doc.rect(15, 75, docWidth - 30, 2).fillAndStroke('#00703c')
                }
                header()
                
                let colWidth = (docWidth - 30) * .4 - 15
                let inverseWidth = (docWidth - 30) * .6 - 15

                // this is dynamic now
                doc.fontSize(9)

                let leftBase = 90

                // column 1
                if (product) {
                    doc.fillColor('#000000')
                    doc.text('PRODUCT', 15, leftBase) // 15 is x coord, 90 is y
                    doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                    doc.image(product, 15, leftBase + 20, {
                        width: colWidth
                    })
                    leftBase += 30 + getImageHeight(wrangleImages(-1), colWidth)
                }

                if (schematic) {
                    doc.fillColor('#000000')
                    doc.text('SCHEMATIC', 15, leftBase)
                    doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                    doc.image(schematic, 15, leftBase + 20, {
                        width: colWidth
                    })
                    leftBase += 30 + getImageHeight(wrangleImages(-1), colWidth)
                }

                if (performance) {
                    doc.fillColor('#000000')
                    doc.text('TYPICAL PERFORMANCE', 15, leftBase)
                    doc.rect(15, leftBase + 10, colWidth, 1).fillAndStroke('#00703c')
                    doc.image(performance, 15, leftBase + 20, {
                        width: colWidth
                    })
                    leftBase += 20 + getImageHeight(wrangleImages(-1), colWidth)
                    if (performanceGraphs) {
                        doc.text('Download Performance Curve Graphics', 15, leftBase + 6, {
                            link: performanceGraphs, align: 'center', width: colWidth
                        })
                        leftBase += 12
                    }
                }

                // column 2
                let extra = 0

                doc.fillColor('#000000')
                doc.text('DESCRIPTION', colWidth + 45, 90)
                doc.rect(colWidth + 45, 100, inverseWidth, 1).fillAndStroke('#00703c')
                doc.fillColor('#000000')
                doc.font('Helvetica')
                doc.text(description, colWidth + 45, 105)
                extra += 12 * Math.ceil(doc.widthOfString(description) / inverseWidth)
                extra -= 10

                let bulletTime = doc.widthOfString('• ')

                if (operation.length > 0) {
                    doc.font('Helvetica-Bold')
                    doc.text('OPERATION', colWidth + 45, 120 + extra)
                    doc.rect(colWidth + 45, 130 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                    doc.fillColor('#000000')
                    doc.font('Helvetica')
                    operation.forEach(op => {
                        doc.text('• ', colWidth + 45, 135 + extra)                        
                        doc.text(op, colWidth + 45 + bulletTime, 135 + extra)
                        extra += 12 * Math.ceil(doc.widthOfString(op) / (inverseWidth - bulletTime))
                    })
                    extra -= 10
                }

                if (features.length > 0) {
                    doc.font('Helvetica-Bold')
                    doc.text('FEATURES', colWidth + 45, 150 + extra)
                    doc.rect(colWidth + 45, 160 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                    doc.fillColor('#000000')
                    doc.font('Helvetica')
                    features.forEach(feat => {
                        doc.text('• ', colWidth + 45, 165 + extra)
                        doc.text(feat, colWidth + 45 + bulletTime, 165 + extra)
                        extra += 12 * Math.ceil(doc.widthOfString(feat) / (inverseWidth - bulletTime))
                    })
                    extra -= 10
                }

                if (specifications.length > 0) {
                    doc.font('Helvetica-Bold')
                    doc.text('SPECIFICATIONS', colWidth + 45, 180 + extra)
                    doc.rect(colWidth + 45, 190 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                    doc.font('Helvetica')
                    specifications.forEach(spec => {
                        doc.fillColor('#000000')
                        doc.text(spec[0], colWidth + 45, 195 + extra)
                        doc.text(spec[1], 0, 195 + extra, {align: 'right'})
                        doc.rect(colWidth + 45, 205 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                        extra += 15
                    })
                }
                
                if (ordering) {
                    doc.font('Helvetica-Bold')
                    doc.fillColor('#000000')
                    doc.text('ORDERING INFORMATION', colWidth + 45, 210 + extra)
                    doc.rect(colWidth + 45, 220 + extra, inverseWidth, 1).fillAndStroke('#00703c')
                    doc.image(ordering, colWidth + 45, 230 + extra, {
                        width: colWidth
                    })
                    extra += getImageHeight(wrangleImages(-1), colWidth)
                }

                let theBottom = (leftBase > 230 + extra) ? leftBase : 230 + extra

                doc.rect(colWidth + 30, 90, 2, theBottom - 90).fillAndStroke('#00703c')

                let availableSpace = (docHeight - 75) - (theBottom)
                let maxRows = Math.floor((availableSpace - 8) / 15)
                
                // bottom column
                function footer() {
                    doc.fillColor('#000000')
                    doc.fontSize(6)
                    doc.font('Helvetica')
                    doc.text(
                        "This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met. The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of Vonberg Valve, Inc. without prior notification.",
                        15, docHeight - 75
                    )

                    doc.fillColor('#00703c')
                    doc.fontSize(8)
                    doc.text(
                        lastUpdated,
                        15, docHeight - 52, {width: docWidth - 30, align: 'right'}
                    )

                    doc.rect(15, docHeight - 43, docWidth - 30, 2).fillAndStroke('#00703c')

                    if (oldLogo) doc.image(oldLogo, 15, docHeight - 40, {fit: [172, 30]})

                    doc.fillColor('#000000')
                    doc.text(
                        '3800 Industrial Avengue • Rolling Meadows, IL 60008-1085 USA © 2015',
                        colWidth + 45, docHeight - 35
                    )
                    doc.text(
                        'phone: 847-259-3800 • fax: 847-259-3997 • email: info@vonberg.com',
                        colWidth + 45, docHeight - 25
                    )
                    if (totalPages > 1) {
                        doc.fontSize(12)
                        doc.text(
                            `${currentPage} / ${totalPages}`,
                            15, docHeight - 30, {width: docWidth - 30, align: 'right'}
                        )
                        currentPage++
                    }
                }

                let base = theBottom + 10

                let tableColWidth = Math.floor((docWidth - 30) / totalCol)
                let cellWidths = {cols: seriesTable[0].length}
                seriesTable.forEach(function(row) {
                    row.forEach(function(cell, index) {
                        if (!cellWidths[index]) cellWidths[index] = 1
                        if (cell.val.length > cellWidths[index]) cellWidths[index] = cell.val.length
                    })
                })
                cellWidths.total = 0
                for (let i = 0; i < cellWidths.cols; i++) {
                    cellWidths.total += cellWidths[i]
                }
                let widthRef = []
                for (let i = 0; i < cellWidths.cols; i++) {
                    widthRef.push(Math.floor((docWidth - 30) * (cellWidths[i] / cellWidths.total)))
                }

                function quickSum(arr) {
                    let total = 0
                    if (arr) arr.forEach(function(n) {total += n})
                    return total
                }

                if (seriesTable.length > maxRows) {
                    totalPages++
                    footer()
                    doc.addPage({
                        margin: 15
                    })
                    header()
                    base = 90
                } else if (seriesTable[0].length > 1) {
                    doc.rect(15, base, docWidth - 30, 2).fillAndStroke('#00703c')
                    base += 8
                }

                if (seriesTable[0].length > 1) {
                    if (seriesTable[0].length > 8) doc.fontSize(8)
                    seriesTable.forEach(function(row, yIndex) {
                        doc.fillColor('#000000')
                        if (yIndex === 0) doc.font('Helvetica-Bold')
                        row.forEach(function(cell, xIndex) {
                            let match = /\r|\n/.exec(cell.val)
                            if(match) {
                                console.log("Cell value: ", cell.val)
                                let updated = cell.val.replace(/\r|\n/g, ' ')
                                doc.text(updated, 15 + quickSum(widthRef.slice(0, xIndex)), base)
                            } else {
                                doc.text(cell.val, 15 + quickSum(widthRef.slice(0, xIndex)), base)
                            }
                        })
                        doc.rect(15, base + 10, docWidth - 30, 1).fillAndStroke('#00703c')
                        base += 15
                        if (yIndex === 0) doc.font('Helvetica')
                    })
                }

                footer()

                doc.end()
                stream.on('finish', () => {
                    blob = stream.toBlob('application/pdf')
                    let a = document.createElement('a')
                    let url = URL.createObjectURL(blob)
                    a.href = url

                    let cat_repl = titleCase(category)
                    let ser_repl = titleCase(series)
                    cat_repl = cat_repl.replace(/ /g, "_")
                    ser_repl = ser_repl.replace(/ /g, "_")

                    a.download = "VONBERG-" + cat_repl + "-" + style + "-" + ser_repl + '.pdf'
                    document.body.appendChild(a)
                    a.click()
                    setTimeout(() => {
                        document.body.removeChild(a)
                        window.URL.revokeObjectURL(url)
                    }, 3000)
                })
            }
        }
        ajax.send()
    }

    $(document).ready(function(){
        if(redir['reload'] == 'no') {
            console.log("Page has not been reloaded");
        } else if (check['reload'] == 'yes') {
            $("#get-stp-form").css('display', 'none');
            $(".get-header").css('display', 'none');
            $("#thanks").css('display', 'block');
            $("#get-stp-modal").modal('show');
        }
        var feedback = '<p class="invalid-feedback">This field is required.</p>';
        $("input:not(input[type=hidden])").each(function(index) {
            $(this).after(feedback)
        });
        $("#get-stp-form .input").not("#get-stp-form .input.checkbox").addClass('form-group');

        $("a.drop-toggle").click(function(e) {
            e.preventDefault();
            var eachClass = $(this).closest("p.model-table-data").next(".mob-hidden").attr("class");
            var res = eachClass.replace(' ', '.');
            var leftDiv = $(this).closest(".col-7").prev(".col-5").find("div").filter('.' + res);
            if(leftDiv.css('display') == "none") {
                $(this).closest("p.model-table-data").next('.mob-hidden').show();
                leftDiv.show();
                $(this).text("View Less");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Up.svg');
            } else {
                $(this).closest("p.model-table-data").next('.mob-hidden').hide();
                leftDiv.hide();
                $(this).text("View More");
                $(this).next("span").find("img.mob-arrow").attr('src', '/img/Arrow-Down.svg');
            }
        })
    })
</script>