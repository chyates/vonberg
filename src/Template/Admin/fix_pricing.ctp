<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div class="container">
    <div class="row">
        <div class="dealers index col-xs-8">
            <h3><?= __('All Parts') ?></h3>
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('categoryID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('seriesID') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($parts as $part): ?>
                    <tr>
                        <td><?= h($part->category->name) ?></td>
                        <td><?= h($part->series->name) ?></td>
                        <td class="actions">
                            <div class="table-responsive">
                                <table class="model-table table">
                                    <thead>
                                    <?php
                                    $columns=0;
                                    foreach ($part->model_table->model_table_headers as $header): ?>
 <?php                                   if ($columns==0){ ?>
                                        <th class="model-table-header"><?php echo $header->model_table_text; ?></th>
<?php                                  }
                                    $columns++;
                                    endforeach; ?>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <?php
                                        $count=1;
                                        $mobCount = 0;
                                        foreach ($part->model_table->model_table_rows as $row):
                                            if ($count == 1){
                                                echo '<td class="model-table-data">';
                                                echo $this->Html->link("Fix".$row->model_table_row_text, "/admin/pricefix", array("class" => "btn btn-primary"));
                                                echo '</td>';

                                            }
                                            if ($count >= $columns){
                                                echo '</tr>';
                                                $count=0;
                                            }
                                            $count++;
                                            $mobCount++;
                                        endforeach;
                                        ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>



                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
        </div>
    </div>

