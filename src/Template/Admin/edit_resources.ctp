<div id="cms-edit-resource-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Edit Resources</h1>

    <div id="delete-check-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col">
                        <h1 class="page-title">Delete File?</h1>
                        <p>Are you sure you want to delete</p>
                        <p id="partname">FPO FILE TEXT</p>
                        <p>from the system? This action cannot be undone.</p>
                        <div class="btn-row">
                            <button type="button" class="back btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">General Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($generals as $g_resource): ?>
                <tr>
                    <td><input type="text" class="form-control" placeholder="<?= $g_resource->title ?>"></td>
                    <td>
                        <?= $this->Text->truncate(
                            $g_resource->files,
                            15,
                            [
                                'ellipsis' => '...',
                                'exact' => false
                            ]) ?>
                    </td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="" data-toggle="modal" data-target="#delete-check-modal">Delete</a></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Technical Documentation</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($technicals as $t_resource): ?>
                <tr>
                    <td><input type="text" class="form-control" placeholder="<?= $t_resource->title ?>"></td>
                    <td>
                        <?= $this->Text->truncate(
                            $t_resource->files,
                            15,
                            [
                                'ellipsis' => '...',
                                'exact' => false
                            ]) ?>
                    </td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->

    <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <h2 class="category-title">Application Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($applications as $a_resource): ?>
                <tr>
                    <td><input type="text" class="form-control" placeholder="<?= $a_resource->title ?>"></td>
                    <td>
                        <?= $this->Text->truncate(
                            $a_resource->files,
                            15,
                            [
                                'ellipsis' => '...',
                                'exact' => false
                            ]) ?>
                    </td>
                    <td class="d-flex justify-content-between">
                        <label class="fileContainer">Browse
                            <input type="file" class="form-control"/>
                        </label>
                        <p class="file-text">No file chosen</p>
                        <button type="submit" class="btn btn-primary update-button">Replace</button>
                        <p><a href="">Delete</a></p>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- .rsrc-table end -->
</div><!-- #cms-edit-resource-main end -->