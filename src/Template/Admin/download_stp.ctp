<div id="cms-stp-download-main" class="inner-main col-md-10 mx-auto">
    <h1 class="page-title">STP Download Report</h1>
    <p class="text-center"><a class="btn btn-primary" href="/admin/stpExport" download>Download As CSV</a></p>

    <div class="table-responsive">
        <table id="cms-stp-down-table" class="model-table table table-striped">
            <thead>
                <tr>
                    <th class="model-table-header">Name</th>
                    <th class="model-table-header">Email</th>
                    <th class="model-table-header">Company</th>
                    <th class="model-table-header">Last Login</th>
                    <th class="model-table-header">Files Acquired</th>
                </tr>
            </thead>
            <tbody>
                <!-- This content should be replaced with dynamically generated content from the database. -->
                <?php foreach ($stp_users as $user): 
                    if( $user->first_name !== '') { ?>
                    <tr>
                        <td class="model-table-data"><?= h($user->first_name) ?> <?= h($user->last_name) ?></td>
                        <td class="model-table-data"><?= h($user->email) ?></td>
                        <td class="model-table-data"><?= h($user->company) ?></td>
                        <td class="model-table-data"><?= h(date('M j Y', strtotime($user->last_login)))?></td>

                        <!-- If the user downloaded more than one file, they should populate with line breaks within the table data tag -->
                        <td class="model-table-data">
                            <?php foreach ($user->stp_file as $model): ?>

                                    <p>MODEL <?= h($model->modelID) ?></p>
                                <?php
                            endforeach; ?>
                        </td>
                    </tr>
                <?php } 
                endforeach; ?>
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
</div><!-- #cms-prod-cat-main end -->