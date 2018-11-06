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
                    <th class="model-table-header">Last Login&nbsp;&nbsp;</th>
                    <th class="model-table-header">Files Requested</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($stp_users as $user): 
                if( $user->first_name !== '') {
                    if(strlen($user->email) > 25) {
                        $at_index = strpos($user->email, "@");
                        $up_email = substr_replace($user->email, "<br>", $at_index+1, 0);
                    }
            ?>
                <tr>
                    <td class="model-table-data"><?= h($user->first_name) ?> <?= h($user->last_name) ?></td>
                    <?php if(!empty($up_email)) { ?>
                        <td class="model-table-data"><?php echo $up_email; ?></td>
                        <?php $up_email = NULL; ?>
                    <?php } else { ?>
                        <td class="model-table-data"><?= h($user->email) ?></td>
                    <?php } 
                        if(strlen($user->company) > 25) {
                            if(strlen($user->company) % 2 != 0) {
                                $midpoint = intval(strlen($user->company)/2 + 0.5);
                            } else {
                                $midpoint = strlen($user->company)/2;
                            }
                            if($user->company[$midpoint] != " ") {
                                $closest = $midpoint;
                                while($user->company[$closest] != " " && $closest < strlen($user->company)-1) {
                                    $closest++;
                                }
                                $split = substr_replace($user->company, "<br>", $closest, 0);
                            } else {
                                $split = substr_replace($user->company, "<br>", $midpoint, 0);
                            }
                    ?>
                        <td class="model-table-data"><?php echo $split; ?></td>
                    <?php } else { ?>
                        <td class="model-table-data"><?= h($user->company) ?></td>
                    <?php } ?>
                    <td class="model-table-data"><?= h(date('M j Y', strtotime($user->last_login)))?></td>
                    <td class="model-table-data">
                        <?php foreach ($user->stp_file as $model): ?>
                                <p>MODEL <?= h($model->modelID) ?></p>
                            <?php
                        endforeach; ?>
                    </td>
                </tr>
            <?php } 
                endforeach; 
            ?>
            </tbody>
        </table>
    </div>
</div><!-- #cms-prod-cat-main end -->