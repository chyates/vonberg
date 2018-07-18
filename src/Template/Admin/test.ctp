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
                <a href="<?= "/img/pdfs/technical_specifications/" . $spec->files; ?>" target="_blank">
                    <?php echo $this->Text->truncate(
                        $spec->files, 15, 
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

<?php 
        // public function editProductOne($id)
    // {
    //     $this->viewBuilder()->setLayout('admin');
    //     if ($this->request->is('post') || $this->request->is('put'))  {
    //         $this->loadModel('Parts');
    //         $part = $this->Parts->get($id);
    //         $part = $this->Parts->patchEntity($part, $this->request->data);
    //         $part->last_updated = date("Y-m-d H:i:s");
    //         if($this->Parts->save($part)){
    //             $this->redirect(array('action' => 'editProductTwo',$part->partID));
    //         }
    //     }
    //     $this->loadModel('TextBlocks');
    //     $this->loadModel('Parts');
    //     $opblock = $this->TextBlocks->find('all',array(
    //         'conditions' => array(
    //             'partID' => $id,
    //         ),
    //         'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text']]),
    //     ));
    //     $part = $this->Parts->get($id);

    //     $cat = TableRegistry::get('Categories')->find('list');
    //     $type = TableRegistry::get('Types')->find('list');
    //     $style = TableRegistry::get('Styles')->find('list');
    //     $series = TableRegistry::get('Series')->find('list');
    //     $conn = TableRegistry::get('Connections')->find('list');

    //     $this->set('conn', $conn);
    //     $this->set('cat', $cat);
    //     $this->set(compact('series'));
    //     $this->set('part', $part);
    //     $this->set('type', $type);
    //     $this->set('style', $style);
    //     $this->set('opblock', $opblock);
    // }
?>