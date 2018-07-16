    <!-- <div class="table-responsive justify-content-between rsrc-table col-md-11 mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Edit Title</th>
                    <th>Current File</th>
                    <th>Replace File</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($specs as $spec): ?>
                <form id="edit-app-rsrc">
                    <tr>
                        <td>
                            <input type="text" class="title-in form-control" placeholder="<?php echo $spec->title;?>">
                        </td>
                        <td>
                            <a href=<?= "/img/pdfs/technical_specifications/".$spec->file; ?> target="_blank">
                                <?php echo $this->Text->truncate(
                                    $spec->file, 15, 
                                    [
                                        'ellipsis' => '...',
                                        'exact' => false
                                    ]); 
                                ?>
                            </a>
                        </td>
                        <td class="d-flex justify-content-between">
                            <label class="fileContainer">Browse
                                <input type="file" class="form-control"/>
                            </label>
                            <p class="file-text">No file chosen</p>
                            <!-- <?php 
                                echo $this->Form->input('tech_id', ['type' => 'hidden', 'label' => false, 'value' => $spec->techID]);
                                echo $this->Form->input('tech_title', ['type' => 'hidden', 'label' => false, 'placeholder' => $spec->title]);
                                echo $this->Form->input('file_path', ['type' => 'hidden', 'label' => false, 'placeholder' => $spec->file]);
                                echo $this->Form->submit('replace', array('class' => 'btn btn-primary update-button')); 
                            ?> -->
                        <?php
                            echo $this->Html->link(
                                $this->Html->tag('delete', 'Delete'),
                                '#',
                                array(
                                    'id'=>'btn-confirm',
                                    'data-toggle'=> 'modal',
                                    'data-id' => $spec->techID,
                                    'data-file'=> $spec->title,
                                    'data-target' => '#delete-check-modal',
                                    'data-action'=> Router::url(
                                        array('action'=>'resourceDelete', $spec->techID)
                                    ),
                                    'escape' => false),
                                    false
                                );
                                ?>
                        </td>
                    </tr>
                </form>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div> -->
    <!-- <?= $this->Form->end();  ?> -->

    