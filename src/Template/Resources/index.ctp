<div id="resources-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <h1 class="page-title">Resources</h1>
    <div class="row no-gutters my-4">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="row no-gutters justify-content-center">
                <!-- <div class="resource-block col-sm-5 p-4 mx-3 mb-3">
                    <h2>General Information</h2>
                    <p class="resource-link"><span class="pr-3"><img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/></span><a href="/img/pdfs/technical_specifications/Vonberg_Product_Tech_Bulletin_Check-Valve.pdf" target="_blank">Technical Bulletin - Check Valve</a></p>
                    <a class="btn btn-primary my-4" href="/resources/general-information">View All</a>
                </div> -->
                <div class="resource-block col-sm-5 p-4 mx-3 mb-3">
                    <h2>General Information</h2>
                    <?php foreach($generals as $spec): ?>
                        <p class="resource-link"><span class="pr-3"><img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/></span><a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank"><?php echo $spec->title;?></a></p>
                    <?php endforeach; ?>
                    <a class="btn btn-primary my-4" href="/resources/general-information">View All</a>
                </div>
                <div class="resource-block col-sm-5 p-4 mx-3 mb-3">
                    <h2>Technical Documentation</h2>
                    <?php foreach($technicals as $spec): ?>
                        <p class="resource-link"><span class="pr-3"><img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/></span><a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank"><?php echo $spec->title;?></a></p>
                    <?php endforeach; ?>
                    <a class="btn btn-primary my-4" href="/resources/technical-documentation">View All</a>
                </div>
            </div>
            <div class="row no-gutters justify-content-center">
                <div class="resource-block col-sm-5 p-4 mx-3 mb-3">
                    <h2>Application Information</h2>
                    <?php foreach($applications as $spec): ?>
                        <p class="resource-link"><span class="pr-3"><img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/></span><a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank"><?php echo $spec->title;?></a></p>
                    <?php endforeach; ?>
                    <a class="btn btn-primary my-4" href="/resources/application-information">View All</a>
                </div>

                <div class="resource-block col-sm-5 p-4 mx-3 mb-3">
                    <h2>Base Product Prices</h2>
                    <?php echo $this->Form->create(null, ['type' => 'get','valueSources' => 'query','url' => ['controller' => 'Products', 'action' => 'prices']]);?>
                    <?PHP $this->Form->unlockField('q');?>
                    <?PHP $this->Form->unlockField('seriesID');?>
                    <label>Enter Model Number</label>
                    <input type="text" class="form-control" name="product-model">
                    <p class="text-center">or</p>
                    <label>Select a Series</label>
                    <select class="form-control" name="product-series">
                        <option value="" selected="selected">Select from dropdown...</option>
                        <?php foreach($series as $item) { ?>
                            <option value="<?php echo $item['seriesID']; ?>"><?php echo $item['name']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" class="btn btn-primary my-4" value="Get Prices"/>
                    <?php echo $this->Form->end(); ?>
                </div>
                <button type="button" class="btn download-btn btn-primary my-4">Download Product Catalogue</button>
            </div>
        </div>
    </div>
</div><!-- #resources-main-end -->