<form class="edit-rsrc-form" action="/admin/edit-application-information" id="<?= $spec->techID ?>">
    <input type="hidden" name="tech_id" value="<?= $spec->techID; ?>">
    <div class="spec-row row">
        <div class="col-md-3">
            <h4 class="rsrc-col-title">Edit Title</h4>
            <input type="text" name="tech_title" class="form-control" placeholder="<?= $spec->title ?>">
        </div>
        <div class="col-md-3">
            <h4 class="rsrc-col-title">Current File</h4>
            <p>
                <a href="<?= "/img/pdfs/technical_specifications/" . $spec->file; ?>" target="_blank">
                    <?php echo $this->Text->truncate(
                        $spec->file, 15, 
                        [
                            'ellipsis' => '...',
                            'exact' => false
                        ]); 
                    ?>
                </a>
            </p>
        </div>
        <div class="col-md-6">
            <h4 class="rsrc-col-title">Replace File</h4>
            <div class="row no-gutters">
                <div class="col">
                    <label class="fileContainer">Browse
                        <input type="file" name="file_path" class="form-control"/>
                    </label>
                    <p class="file-text">No file chosen</p>
                    <input type="submit" class="btn btn-primary update-button" value="Replace">
                </div>
            </div>
        </div>
    </div>
</form>