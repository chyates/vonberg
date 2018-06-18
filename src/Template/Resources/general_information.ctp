<div id="gen-info-main-container" class="inner-main col-lg-10 col-12 mx-auto p-lg-5 p-3">
    <div class="col-lg-6 col-12 mx-auto">
        <h1 class="page-header">General Information</h1>
        <p class="product-info">Download a PDF below for general company reference material. Please note that these files are the latest versions, and any previously saved or printed materials may be out of date and, therefore, incorrect.</p>

        <!-- Following is copy for App Info page:
        <p class="product-info">Vonberg understands that each application has its own unique requirements. See how our products are designed and tuned for these specific applications.</p> -->
        
        <div class="resource-block p-sm-4 p-3 my-4">
            <?php
            foreach ($specs as $spec): ?>
                <p class="resource-link"><span class="pr-3">
                        <img class="img-fluid" src="/img/Adobe_PDF_file_icon@2x.png"/></span><a href="/img/pdfs/technical_specifications/<?php echo $spec->file;?>" target="_blank"><?php echo $spec->title;?></a></p>
            <?php endforeach;?>
        </div>
        
        <h3 class="product-name">Don't see what you're looking for?</h3>
        <button type="button" class="d-block mx-auto btn btn-primary contact-us"><a href="/contact">Contact Us</a></button>
    </div>
</div><!-- #gen-info-main-container end -->