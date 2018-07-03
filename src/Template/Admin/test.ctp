<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-three" class="active-title page-title">Edit Product: Series Table</h1>
    <?= $this->Form->create('', ['id' => "edit-prod-three-form"]) ?>
        <div id="three" class="active-slide form-slide">
            <div class="buffer-div">
                <div class="table-create-box p-3" style="overflow: scroll;">
                    <table style="border: 0"id="formdata" border="2">
                        <tr>
                            <?php 
                                $headerCounter = 0;
                                if(!empty($table)) {
                                    $headCount = count($table->model_table_headers);
                                    echo $headCount;
                                    foreach ($table->model_table_headers as $h):
                                        $header = 'header['.$headerCounter.']'; 
                            ?>
                                        <td data-row="-1" data-col="<?= $headerCounter ?>">
                                            <?= $this->Form->input($header, array('type'=>'text','class' => ' header-element','label'=> False, 'value' => $h->model_table_text));?>
                                        </td>
                                        <?php $headerCounter++;
                                    endforeach; 
                                 } else { 
                            ?>
                                <td data-row="-1" data-col="<?= $headerCounter?>">
                                    <?php $header = 'header['.$headerCounter.']'; ?>
                                    <span class="addnewheader">Add New Header:</span><br>
                                    <input id="<?= $header ?>" name="<?= $header ?>" class="header-element" type="text" value="">
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                            $rowCount  = 0;
                            $colCount  = 0;
                            $open  = "<tr>";
                            $close = "</tr>";
                            if(!empty($table)) {
                                foreach ($table->model_table_rows as $r):
                                    $tablename = 'table['.$rowCount.']['.$colCount.']';
                                    if ($colCount == '0'){
                                        echo $open;
                                    }
                        ?>
                                    <td data-row="<?= $rowCount ?>" data-col="<?= $colCount ?>">
                                        <?= $this->Form->input($tablename, array('type'=>'text','class' => 'table-element','label'=> False, 'value' => $r->model_table_row_text));?>
                                    </td>

                                <?php 
                                    $colCount++;
                                    if ($colCount == $headCount) {
                                        echo $close;
                                    }

                                    if ($colCount == $headCount) {
                                        $rowCount++;
                                        $colCount = 0;
                                    }

                                endforeach; 
                            $rowCount++;
                            $colCount = 0; 
                            ?>
                        <tr>
                            <?php 
                            foreach (range(0, ($headerCounter-1)) as $i):
                                $tablename = 'table['.$rowCount.']['.$colCount.']';
                            ?>
                                <td data-row="<?= $rowCount?>" data-col="<?=$colCount?>">
                                    <input id="<?= $tablename?>" class="table-element" name="<?=$tablename?>" type="text" value="">
                                </td>
                        <?php 
                                $colCount++;
                            endforeach; } 
                        ?>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row no-gutters justify-content-between">
                <a id="back-three" class="back btn btn-primary">Back</a>
                <?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>
            </div>
        </div><!-- #three end -->

    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->

<script>
    function addNewColumn() {
        var $table = $('#formdata');

        $table.find('tr').each(function(i,el) {
            var $row = $(this),
                $lastcell = $row.find('input[type=text]:last').closest('td'),
                $newcell = $lastcell.clone(true,true),
                newrow = $newcell.data('row') || 0,
                newcol = $newcell.data('col')+1,
                newid = (newrow==-1) ? 'header['+newcol+']' : 'table['+newrow+']['+newcol+']';

            if (newrow==-1) {
                $('.addnewheader').remove(); // from document, not $newcell
            };
            $row.find('input').off('blur');
            $newcell.data('col',newcol)
                .find('input')
                .attr({
                    'id': newid,
                    'name': newid
                })
                .val('')
                .end()
                .insertAfter($lastcell);
            if (newrow==-1) {
                $newcell.find('input').focus();
            };
        });
    };

    function addNewRow() {
        var $table = $('#formdata'),
            $lastrow = $table.find('input[type=text]:last').closest('tr'),
            $newrow = $lastrow.clone(true,true);

        $newrow.find('td').each(function(i,el) {
            var $cell = $(this),
                newrow = $cell.data('row')+1,
                newcol = $cell.data('col') || 0,
                newid = 'table['+newrow+']['+newcol+']';

            $cell.data('row',newrow)
                .find('input')
                .attr({
                    'id': newid,
                    'name': newid
                })
                .val('');
        });
        $lastrow.find('input:last').off('blur');
        $newrow.insertAfter($lastrow).find('input:first').focus();
    };

    $(document).ready(function() {
        $('.header-element:last').on('blur',function(e) {
            if ($.trim($(this).val()).length) {
                addNewColumn();
            };
        });
        $('.table-element:last').on('blur',function(e) {
            if ($.trim($(this).val()).length) {
                addNewRow();
            };
        }).closest('tr').find('.table-element:first').focus();
    });
</script>

<?php

    if (strval($model) != 0) {
        $tables = $this->ModelTableRows->find('all', array(
            'conditions' => array(
                    'model_table_rowID' => $model,
                ),
            ))->first();
                $file_paths .= $tables;
                array_push($models, $tables);
            }
    }

    if(!empty($this->request->data['model'])) {
        foreach($this->request->data['model'] as $str_model) {
            if(strval($str_model) != 0) {
                $file_paths .= ' '.strval($str_model)."stp,";
            }
        }
    }

    $files=$this->StpFile->newEntity();
    $files->stp_userID = $result->stp_userID;
    $files->partID = $final_id;
    $files->modelID = $model;
    $files = $this->StpFile->save($files);

    $paths_2 .= $model;

    // Send email to client:
    $attachments = $file_array;
    $email = new Email('default');
    $email->from(['do-not-reply@vonberg.com'])
        ->to(['chyatesil@gmail.com', 'Carolyn Yates'])
        $email->addTo('jlevon@vonberg.com');
        $email->addTo('Mwhite@vonberg.com');*/
        ->subject('File Request from '.$this->request->data['email'])
        ->viewVars(['data'=> $result, 'models' => $models])
        ->template('stp_email','default')
        ->send();

        if($this->request->is('post') || $this->request->is('put')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);

            if($result=$this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                $this->Flash->success(__('The request has been saved.'));
                
                // $file_paths = '';

                // foreach ($this->request->data['model'] as $model) {
                //     array_push($models, $model);
                // }
                Email::deliver('chyatesil@gmail.com', 'STP File Request From: '.$this->request->data['first_name']." ".$this->request->data['last_name'], 'Please respond to: '.$this->request->data['email'].' with the following *no-zero* files: space ', ['from' => 'do-not-reply@vonberg.com']);
        } else {
            $data['response'] = "Error: some error";
            print_r($emp);
            $this->Flash->success(__('The request has not been saved.'));
        }
?>