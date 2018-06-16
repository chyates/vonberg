<div id="cms-stp-download-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 class="page-title">Contact Page Report</h1>
    <p class="text-center"><a class="btn btn-primary" href="/admin/contactExport" download>Download As CSV</a></p>

    <div class="table-responsive">
        <table id="cms-stp-down-table" class="model-table table table-striped">
            <thead>
                <tr>
                    <th class="model-table-header">Name</th>
                    <th class="model-table-header">Company</th>
                    <th class="model-table-header">Address</th>
                    <th class="model-table-header">Email</th>
                    <th class="model-table-header">Contacted</th>
                    <th class="model-table-header">Question</th>
                </tr>
            </thead>
            <tbody>
                <!-- This content should be replaced with dynamically generated content from the database. -->
                <?php foreach ($contacts as $user): ?>
                    <tr>
                        <td class="model-table-data"><?= h($user->name) ?></td>
                        <td class="model-table-data"><?= h($user->company) ?></td>
                        <td class="model-table-data"><?= h($user->address) ?><?php if ($user->address2) { echo '<BR>'.$user->address2; } ?><BR><?= h($user->city) ?>, <?= h($user->state) ?> <?= h($user->zip) ?></td>
                        <td class="model-table-data"><?= h($user->email) ?></td>
                        <td class="model-table-data"><?= h(date('M j Y', strtotime($user->date_submitted)))?></td>
                        <td class="model-table-data"><?= h($user->contactme) ?></td>
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
</div><!-- #cms-prod-cat-main end -->