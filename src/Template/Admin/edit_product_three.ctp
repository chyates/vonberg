<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <!-- This page acts almost identically to the add product page except the 
    information for the current product should be auto-populated in each field. -->
    <?= $this->Form->create('', ['id' => "edit-prod-three-form"]) ?>
<!--    <form id="edit-prod-form">-->
        <h1 id="title-three" class="active-title page-title">Edit Product: Series Table</h1>


        <div id="three" class="active-slide form-slide">
            <div class="buffer-div">
                <div class="table-create-box p-3" style="overflow: scroll;">
                    <?php if ($debug){ echo $debug;}?>
                    <table style="border: 0"id="formdata" border="2">
                        <tr>
                            <?php $headCount = count($table->model_table_headers);?>
                            <?php $headerCounter = 0; ?>
                            <?php foreach ($table->model_table_headers as $h): ?>
                            <?php $header = 'header['.$headerCounter.']'; ?>
                            <td data-row="-1" data-col="<?= $headerCounter ?>">
                                <?= $this->Form->input($header, array('type'=>'text','class' => ' header-element','label'=> False, 'value' => $h->model_table_text));?>
                            </td>
                            <?php $headerCounter++;
                            ?>
                            <?php endforeach; ?>
                            <td data-row="-1" data-col="<?= $headerCounter?>">
                                <?php $header = 'header['.$headerCounter.']'; ?>
                                <span class="addnewheader">Add New Header:</span><br>
                                <input id="<?= $header ?>" name="<?= $header ?>" class="header-element" type="text" value="">
                            </td>
                        </tr>
                        <?php
                        $rowCount  = 0;
                        $colCount  = 0;
                        $open  = "<tr>";
                        $close = "</tr>";
                        ?>

                <?php foreach ($table->model_table_rows as $r):
                        $tablename = 'table['.$rowCount.']['.$colCount.']';

                        if ($colCount == '0'){
                        echo $open;
                        }
                        ?>
                        <td data-row="<?= $rowCount ?>" data-col="<?= $colCount ?>">
                            <?= $this->Form->input($tablename, array('type'=>'text','class' => 'table-element','label'=> False, 'value' => $r->model_table_row_text));?>
                        </td>

                        <?php $colCount++;

                        if ($colCount == $headCount) {
                        echo $close;
                        }

                        if ($colCount == $headCount) {
                        $rowCount++;
                        $colCount = 0;
                        }

                        endforeach; ?>

<?php $rowCount++; ?>
<?php $colCount = 0; ?>
                        <tr>
                            <?php foreach (range(0, ($headerCounter-1)) as $i):
                            $tablename = 'table['.$rowCount.']['.$colCount.']';?>
                            <td data-row="<?= $rowCount?>" data-col="<?=$colCount?>">
                                <input id="<?= $tablename?>" class="table-element" name="<?=$tablename?>" type="text" value="">
                            </td>
                            <?php $colCount++; ?>
	<?php endforeach; ?>
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