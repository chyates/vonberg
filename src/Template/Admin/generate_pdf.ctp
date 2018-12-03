<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<div id="cms-gen-pdf-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- <style>#one select option[value*="0"] {display: none}</style> -->
    <?= $this->Form->create('', ['id' => "gen-pdf-form", 'enctype' => 'multipart/form-data']) ?>
    
    <div id="one" class="active-slide form-slide col-md-5 mx-auto">
        <h1 id="title-one" class="active-title page-title">Generate Custom PDF</h1>
        <div class="form-group">
            <?php 
                echo $this->Form->input('categoryID',
                [
                    'type' => 'select',
                    'multiple' => false,
                    'options' => $cat,
                    'label' => 'Category',
                    'class' => 'form-control'
                ]);

                echo $this->Form->input('newcat', 
                [
                    'type' => 'text',
                    'label' => false,
                    'class' => 'hidden form-control',
                    'id' => 'newcat',
                    'placeholder' => 'Enter custom category'
                ]);
            ?>
        </div>

        <label>Style</label>
        <div class="form-group">
            <?php 
                echo $this->Form->control('styleID',
                [
                    'templates'  => [ 'inputContainer' => '<div class="input form-check form-check-inline {{type}}{{required}}">{{content}}</div>'],
                    'type' => 'radio',
                    'multiple' => false,
                    'options' => $style,
                    'label' => False,
                    'class' => 'form-check-input'
                ]);
            ?>
        </div>

        <!-- Type -->
        <div class="form-group">
            <?php 
                echo $this->Form->input('typeID',
                [
                    'type' => 'select',
                    'multiple' => false,
                    'options' => $type,
                    'label' => 'Type',
                    'class' => 'form-control'
                ]);

                echo $this->Form->input('newtype', 
                [
                    'type' => 'text',
                    'label' => false,
                    'class' => 'hidden form-control',
                    'id' => 'newtype',
                    'placeholder' => 'Enter custom type'
                ]);
            ?>
        </div>
            
        <!-- Series -->
        <div class="form-group">
            <?php
                echo $this->Form->input('seriesID',
                [
                    'type' => 'select',
                    'multiple' => false,
                    'options' => $series,
                    'label' => 'Series',
                    'class' => 'form-control'
                ]);

                echo $this->Form->input('newseries', 
                [
                    'type' => 'text',
                    'label' => false,
                    'class' => 'accept hidden form-control',
                    'id' => 'newseries',
                    'placeholder' => 'Enter custom series'
                ]);
            ?>
        </div>

        <!-- Short Description -->
        <div class="form-group">
            <?php
            echo $this->Form->input('connectionID',
                [
                    'type' => 'select',
                    'multiple' => false,
                    'options' => $conn,
                    'label' => 'Short Description',
                    'class' => 'form-control'
                ]);

            echo $this->Form->input('newconn', 
                [
                    'type' => 'text',
                    'label' => false,
                    'class' => 'accept hidden form-control',
                    'id' => 'newconn',
                    'placeholder' => 'Enter custom short description'
                ]);
            ?>
        </div>
        <p class="text-right">
            <div id="one-two" class="btn btn-primary form-nav">Next</div>
        </p>
    </div><!-- #one end -->

    <div id="two" hidden class="active-slide form-slide col-md-5 mx-auto">
        <h1 id="title-two" class="active-title page-title">Generate Custom PDF: Description and Features</h1>
        <div class="form-group">
            <?php 
            echo $this->Form->control('description',
                [
                    'cols' => 50, 
                    'rows' => 6,
                    'class' => 'form-control',
                    'label' => 'Detail Description:'
                ]);
            ?>
        </div>

        <div class="form-group w-bullet operation">
            <!-- <div class="form-group"> -->
                <label>Operation</label>
                <?php 
                    echo $this->Form->input('op_bullet_text_1', array(
                        'class' => 'form-control', 
                        'label' => false, 
                        'id' => '1'
                    ));
                ?>
                <a class="plus add-bullet" href="">Add Bullet</a>
                <a class="del add-bullet" href="">Remove Bullet</a>
            <!-- </div> -->
        </div>

        <div class="form-group w-bullet features">
            <label>Features</label>
            <?php
                echo $this->Form->input('feat_bullet_text_1', array(
                    'class' => 'form-control', 
                    'label' => false, 
                    'id' => '1'
                ));
            ?>
            <a class="plus add-bullet" href="">Add Bullet</a>
            <a class="del add-bullet" href="">Remove Bullet</a>
        </div>

        <div class="form-group row no-gutters align-items-center w-bullet specifications">
            <label>Specifications</label>
            <!-- <style>.holdit select, .holdit input {display: inline-block; width: 50%}</style> -->
            <?php
                $spec_array = [];
                $options = [];

                foreach($all_specs as $each_spec) {
                    array_push($spec_array, $each_spec->spec_name);
                } 

                for($x = 0; $x < count($spec_array); $x++) {
                    $options[$x] = ['text' => $spec_array[$x], 'value' => $spec_array[$x]];
                }
            ?>
            <div class="row">
                <div class="spec-left col-sm-6">
                <?php 
                    echo $this->Form->select('spec_name_1', $options, 
                    [
                        'class' => 'form-control', 
                        'label' => false, 
                        'id' => '1'
                    ]);
                ?>
                </div>
                <div class="spec-right col-sm-6">
                    <?= $this->Form->input('spec_value_1', array(
                        'class' => 'form-control',
                        'label'=> False, 
                        'id' => '1' ));
                    ?>
                </div>
            </div>
            <!-- <a class="plus add-bullet" href="">Add Bullet</a>
            <a class="del add-bullet" href="">Remove Bullet</a> -->
            <div class="yes-bullet">Add Bullet</div>
            <div class="no-bullet">Remove Bullet</div>
        </div>

        <div class="row no-gutters justify-content-between">
            <div id="two-one" class="back btn btn-primary form-nav">Back</div>
            <div id="two-three" class="btn btn-primary form-nav">Next</div>
        </div>
    </div><!-- #two end -->

    <div id="three" hidden class="active-slide form-slide col-md-12 mx-auto">
        <h1 id="title-three" class="active-title page-title">Generate Custom PDF: Series Table</h1>
        <div class="buffer-div">
            <div class="table-create-box p-3">
                <div class="creation-row row no-gutters">
                    <div class="data-column" id="1">
                        <?php 
                            echo $this->Form->input('table_header_1-1',
                            [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'model-header-input form-control',
                                'placeholder' => 'Model',
                                'id' => '1-1'
                            ]);

                            echo $this->Form->input('table_row_2-1', 
                            [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'model-row-input form-control',
                                'placeholder' => 'Enter model',
                                'id' => '2-1'
                            ]); 
                        ?>
                    </div>
                    <div class="add-column">
                        <a class="model-column plus add-bullet" href="">Add Column</a>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        <a class="model-row plus add-bullet" href="">Add Row</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters mt-4">
            <div class="col-11 mx-auto">
                <div id="three-two" class="back btn btn-primary form-nav">Back</div>
                <div id="three-four" class="btn btn-primary form-nav">Next</div>
            </div>
        </div>
    </div><!-- #three end -->

    <div id="four" hidden class="active-slide form-slide col-md-8 mx-auto table-responsive">
        <h1 id="title-four"class="active-title page-title">Generate PDF: Image Uploads</h1>
        <table class="model-table table">
            <thead>
                <tr>
                    <th class="model-table-header">Image</th>
                    <th class="model-table-header">Upload File</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="first model-table-data">Product Image</td>
                    <td class="d-flex model-table-data justify-content-between">
                        <label class="fileContainer light">Browse
                            <?php 
                                echo $this->Form->input('product', 
                                [
                                    'type' => 'file', 
                                    'class'=>'form-control', 
                                    'label' => false
                                ]);
                            ?>
                        </label>
                        <p class="file-text">No file chosen</p>
                    </td>
                </tr><!-- product image row end -->

                <tr>
                    <td class="first model-table-data">Schematic Drawing</td>
                    <td class="d-flex model-table-data justify-content-between">
                        <label class="fileContainer light">Browse
                            <?php 
                                echo $this->Form->input('schematic', 
                                [
                                    'type' => 'file', 
                                    'class'=>'form-control', 
                                    'label' => false
                                ]);
                            ?>
                        </label>
                        <p class="file-text">No file chosen</p>
                    </td>
                </tr><!-- schematic row end -->

                <tr>
                    <td class="first model-table-data">Ordering Information</td>
                    <td class="d-flex model-table-data justify-content-between">
                        <label class="fileContainer light">Browse
                            <?php 
                                echo $this->Form->input('ordering', 
                                [
                                    'type' => 'file', 
                                    'class'=>'form-control', 
                                    'label' => false
                                ]);
                            ?>
                        </label>
                        <p class="file-text">No file chosen</p>
                    </td>
                </tr><!-- ordering row end -->

                <tr>
                    <td class="first model-table-data">Typical Performance</td>
                    <td class="d-flex model-table-data justify-content-between">
                        <label class="fileContainer light">Browse
                            <?php 
                                echo $this->Form->input('performance', 
                                [
                                    'type' => 'file', 
                                    'class'=>'form-control', 
                                    'label' => false
                                ]);
                            ?>
                        </label>
                        <p class="file-text">No file chosen</p>
                    </td>
                </tr><!-- performance row end -->

            </tbody>
        </table>

        <div class="row no-gutters justify-content-between">
            <div id="four-three" class="back btn btn-primary form-nav">Back</div>
            <div id="generate" class="btn btn-primary">Generate PDF</div>
        </div>
    </div><!-- #four end -->

        <!-- <script src="/js/generate-pdf.js"></script> -->
        <script>
            Array.prototype.forEach.call(document.querySelectorAll('.form-nav'), function(btn) {
                btn.onclick = function() {
                    let from = this.id.split('-')[0]
                    let to = this.id.split('-')[1]
                    document.getElementById(from).hidden = true
                    document.getElementById(to).hidden = false
                }.bind(btn)
            })

            let schematic, performance, product, ordering, oldLogo

            document.getElementById('product').onchange = function(e) {                
                let reader = new FileReader()
                reader.onload = function() {
                    product = reader.result
                }
                reader.readAsDataURL(e.target.files[0])
            }

            document.getElementById('schematic').onchange = function(e) {
                let reader = new FileReader()
                reader.onload = function() {
                    schematic = reader.result
                }
                reader.readAsDataURL(e.target.files[0])
            }

            document.getElementById('ordering').onchange = function(e) {
                let reader = new FileReader()
                reader.onload = function() {
                    ordering = reader.result
                }
                reader.readAsDataURL(e.target.files[0])
            }

            document.getElementById('performance').onchange = function(e) {                
                let reader = new FileReader()
                reader.onload = function() {
                    performance = reader.result
                }
                reader.readAsDataURL(e.target.files[0])
            }

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
            getDataUri('/img/1971-logo.png', function(dataUri) {
                oldLogo = dataUri
            })

            function titleCase(str) {
                return str.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
                })
            }
            
            document.getElementById('generate').onclick = function() {
                let ajax = new XMLHttpRequest()
                ajax.open('GET', '/img/vonberg_logo.png')
                ajax.responseType = 'arraybuffer'
                ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let logo = ajax.response

                        let selType = document.getElementById('typeid')
                        let type = selType[selType.selectedIndex].value != -1 ? selType[selType.selectedIndex].innerText : document.getElementById('newtype').value
                        let selCat = document.getElementById('categoryid')
                        let category = selCat[selCat.selectedIndex].value != -1 ? selCat[selCat.selectedIndex].innerText : document.getElementById('newcat').value
                        let style = document.getElementById('styleid-1').checked ? 'INLINE' : 'CARTRIDGE'
                        let selSeries = document.getElementById('seriesid')
                        let series = selSeries[selSeries.selectedIndex].value != -1 ? selSeries[selSeries.selectedIndex].innerText : document.getElementById('newseries').value
                        let selShortDesc = document.getElementById('connectionid')
                        let shortDescription = selShortDesc[selShortDesc.selectedIndex].value != -1 ? selShortDesc[selShortDesc.selectedIndex].innerText : document.getElementById('newconn').value

                        let description = document.getElementById('description').value.toUpperCase().replace(/˚/g, '\u00B0')

                        let operation = []
                        Array.prototype.forEach.call(document.querySelectorAll('.w-bullet.operation input'), function(bullet) {
                            operation.push(bullet.value.toUpperCase().replace(/˚/g, '\u00B0'))
                        })
                        operation = operation.filter(function(op) {return op != ''})
                        let features = []
                        Array.prototype.forEach.call(document.querySelectorAll('.w-bullet.features input'), function(bullet) {
                            features.push(bullet.value.toUpperCase().replace(/˚/g, '\u00B0'))
                        })
                        features = features.filter(function(feat) {return feat != ''})
                        var specifications = []
                        Array.prototype.forEach.call(document.querySelectorAll('.w-bullet.specifications select'), function(select) {
                            if (select[select.selectedIndex].value != -1) {
                                specifications.push([select[select.selectedIndex].innerText])
                            } else {
                                specifications.push([document.getElementById('cuspec-' + select.id).value])
                            }
                        })
                        Array.prototype.forEach.call(document.querySelectorAll('.w-bullet.specifications .spec-right input'), function(input, index) {
                            specifications[index].push(input.value.replace(/˚/g, '\u00B0'))
                        })
                        specifications = specifications.filter(function(spec) {
                            return spec.filter(function(data) {return data != ''}).length > 0
                        })

                        let seriesInputs = []
                        Array.prototype.forEach.call(document.querySelectorAll('#three input'), function(cell) {
                            let coords = cell.id.split('-')
                            seriesInputs.push({
                                row: Number(coords[0]),
                                col: Number(coords[1]),
                                val: cell.value.toUpperCase().replace(/˚/g, '\u00B0')
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

                        console.log(doc)
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
                            doc.text(category, 0, 15, {
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
                            doc.text(shortDescription, 0, 60, {
                                align: 'right'
                            })

                            doc.rect(15, 75, docWidth - 30, 2).fillAndStroke('#00703c')
                        }
                        header()
                        
                        // let colWidth = (docWidth - 30) / 2 - 15
                        let colWidth = (docWidth - 30) * .4 - 15
                        // let inverseWidth = (docWidth - 30) / 2 - 15
                        let inverseWidth = (docWidth - 30) * .6 - 15

                        // doc.rect(colWidth + 30, 90, 2, 80 + colWidth * 1.9).fillAndStroke('#00703c')
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

                        // if (operation.length > 1 || operation[0].length > 0) {
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

                        // if (features.length > 1 || features[0].length > 0) {
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

                        // if (specifications.length > 1 || specifications[0][1].length > 0) {
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
                            doc.font('Helvetica')
                            doc.fontSize(6)
                            doc.text(
                                "This document, as well as all catalogs, price lists and information provided by Vonberg Valve, Inc., is intended to provide product information for further consideration by users having substantial technical expertise due to the variety of operating conditions and applications for these valves, the user, through its own analysis, testing and evaluation, is solely responsible for making the final selection of the products and ensuring that all safety, warning and performance requirements of the application or use are met. The valves described herein, including without limitation, all component features, specifications, designs, pricing and availability, are subject to change at any time at the sole discretion of Vonberg Valve, Inc. without prior notification.",
                                15, docHeight - 75
                            )

                            doc.rect(15, docHeight - 43, docWidth - 30, 2).fillAndStroke('#00703c')

                            if (oldLogo) doc.image(oldLogo, 15, docHeight - 40, {fit: [172, 30]})

                            doc.fillColor('#000000')
                            doc.fontSize(8)
                            doc.text(
                                '3800 Industrial Avengue • Rolling Meadows, IL 60008-1085 USA © 2015',
                                colWidth + 45, docHeight - 35
                                // 0, docHeight - 35, {align: 'center'}
                            )
                            doc.text(
                                'phone: 847-259-3800 • fax: 847-259-3997 • email: info@vonberg.com',
                                colWidth + 45, docHeight - 25
                                // 0, docHeight - 25, {align: 'center'}
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
                                    doc.text(cell.val, 15 + quickSum(widthRef.slice(0, xIndex)), base)
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
                            // let type_repl = type.replace(/ /g, "_")
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
        </script>

    <?= $this->Form->end(); ?>
</div><!-- #cms-gen-pdf-main end -->

<!-- yo dawg i hurd you liek jquery -->
<script>
    var idArr = [];

    function createArr(sel) {
        sel.find('option')
        .each(function(index) {
            var idInt = parseInt($(this).attr('value'));
            idArr.push(idInt);
        });
        var max = idArr[0];
        for(var i = 1; i < idArr.length; i++) {
            if (idArr[i] > max) {
                max = idArr[i];
            }
        }
        return max;
    }

    function catAdd() {
        var select = $("#add-prod-form").find('#categoryid');
        var last = createArr(select);
        var added = last + 1;
        var name = $("#cat").val();
        $.get('/admin/catadd?name='+name, function(d) {
            $('#categoryid').prepend($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);
        });
    }

    function typeAdd() {
        var select = $("#add-prod-form").find('#typeid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#type").val();
        $.get('/admin/typeadd?name='+name, function(d) {
            $('#typeid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);

        });
    }

    function seriesAdd() {
        var select = $("#add-prod-form").find('#seriesid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#series").val();
        $.get('/admin/seriesadd?name='+name, function(d) {
            $('#seriesid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);
        });
    }

    function connAdd() {
        var select = $("#add-prod-form").find('#connectionid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#conn").val();
        $.get('/admin/connadd?name='+name, function(d) {
            $('#connectionid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);
        });
    }

    function partAdd() {
        $.ajax({
            url: '/admin/part_add',
            type:"POST",
            data:$('#add-prod-form').serialize(),
            success:function(response) {
                alert("success:  "+response);
                location.reload(false);
            },
            error: function (jqXHR,exception) {

                console.log(jqXHR);
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.'+jqXHR.statusText;
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }

                alert(msg);
            }
        });
        location.reload(false);
    }

    jQuery(document).ready(function() {
        // add "add series" to select
        $('#seriesid').prepend($('<option>', {
            value: -1,
            text: 'Custom series...'
        }));
        $('#categoryid').prepend($('<option>', {
            value: -1,
            text: 'Custom category...'
        }));
        $('#typeid').prepend($('<option>', {
            value: -1,
            text: 'Custom type...'
        }));
        $('#connectionid').prepend($('<option>', {
            value: -1,
            text: 'Custom short description...',
            id: 'testID'
        }));

        $("#one select.form-control").on("change", function (e) {
            if (e.target[e.target.selectedIndex].value == -1) {
                var next = $(this).parent("div.input.select").next('div.input.text').find('.hidden')
                next.show();
            }
        });

        $("#edit-prod-form div.input.checkbox").addClass('form-check form-check-inline');

        // i don't get how specs are handled on edit-product-two so i went rogue
        $('.specifications select.form-control').prepend($('<option>', {
            value: -1,
            text: 'Custom specification...'
        }));
        $('.specifications select.form-control').on('change', function(e) {
            if (e.target[e.target.selectedIndex].value == -1) {
                let custom = document.createElement('input')
                custom.id = 'cuspec-' + e.target.id
                custom.className = 'accept form-control custom-spec'
                custom.style.position = 'absolute'
                custom.placeholder = "Enter new specification"
                // custom.style.right = '100%'
                custom.style.width = 'calc(100% - 30px)'
                custom.style.top = (Number(e.target.id) * 38) - 38 + 'px'
                document.querySelector('.specifications .row .col-sm-6').appendChild(custom)
            }
        });

        // coding a unique way of handling everything cause
        // COPULATE THIS FECES

        let specLeft = document.querySelector('.specifications .spec-left')
        let specRight = document.querySelector('.specifications .spec-right')
        let baseSpec = document.querySelector('.specifications .spec-left select').cloneNode(true)
        
        document.querySelector('.specifications .yes-bullet').addEventListener('click', function(e) {
            let newIndex = Array.from(document.querySelectorAll('.specifications .spec-left select')).length + 1
            let newSpec = baseSpec.cloneNode(true)
            newSpec.id = newIndex
            newSpec.selectedIndex = 1
            newSpec.addEventListener('change', function(e) {
                if (e.target[e.target.selectedIndex].value == -1) {
                    let custom = document.createElement('input')
                    custom.id = 'cuspec-' + e.target.id
                    custom.className = 'accept form-control custom-spec'
                    custom.style.position = 'absolute'
                    custom.placeholder = "Enter new specification"
                    // custom.style.right = '100%'
                    custom.style.width = 'calc(100% - 30px)'
                    custom.style.top = (Number(e.target.id) * 38) - 38 + 'px'
                    document.querySelector('.specifications .spec-left').appendChild(custom)
                }
            })
            specLeft.appendChild(newSpec)
            let newInput = document.createElement('input')
            newInput.id = newIndex
            newInput.className = 'form-control'
            specRight.appendChild(newInput)
        })

        document.querySelector('.specifications .no-bullet').addEventListener('click', function(e) {
            let selects = Array.from(document.querySelectorAll('.specifications .spec-left select'))
            let lastSelect = (selects.length > 0) ? selects[selects.length - 1] : null
            if (lastSelect && lastSelect[lastSelect.selectedIndex].value == -1) {
                document.getElementById('cuspec-' + lastSelect.id).remove()
            }
            lastSelect.remove()
            let inputs = Array.from(document.querySelectorAll('.specifications .spec-right input'))
            let lastInput = (inputs.length > 0) ? inputs[inputs.length - 1] : null
            lastInput.remove()
        })

    })
</script>