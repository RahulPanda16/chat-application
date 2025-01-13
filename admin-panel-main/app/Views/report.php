<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Reports
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="active btn btn-focus">SQL Report</button>
                        <button class="btn btn-focus">MongoDB Report</button>
                        <button class="btn btn-focus">Elastic Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<!--  -->
<div class="table-responsive">
    <?php if (session()->getFlashdata("success")) { ?>
        <div class="alert w-50 align-self-center alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata("success"); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if (session()->getFlashdata("fail")) { ?>
        <div class="alert w-50 align-self-center alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata("fail"); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php } ?>

    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center col-sm-4">Id</th>
                <th class="text-center col-sm-4">Date Time</th>
                <th class="text-center col-sm-4">Report Type</th>
                <th class="text-center col-sm-4">Dispose Type</th>
                <th class="text-center col-sm-4">Dispose Name</th>
                <th class="text-center col-sm-4">Call Duration</th>
                <th class="text-center col-sm-4">Agent Name</th>
                <th class="text-center col-sm-4">Campaign Name</th>
                <th class="text-center col-sm-4">Process Name</th>
                <th class="text-center col-sm-4">Leadset Id</th>
                <th class="text-center col-sm-4">Reference Uuid</th>
                <th class="text-center col-sm-4">Customer Uuid</th>
                <th class="text-center col-sm-4">Hold Time</th>
                <th class="text-center col-sm-4">Mute Time</th>
                <th class="text-center col-sm-4">Ringing Time</th>
                <th class="text-center col-sm-4">Transfer Time</th>
                <th class="text-center col-sm-4">Conference Time</th>
                <th class="text-center col-sm-4">Call Time</th>
                <th class="text-center col-sm-4">Dispose Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($accessUser)) {
                foreach ($accessUser as $user) {
            ?>
            <tr>
                <td class="text-center">#<?php echo $user -> id; ?></td>
                <td class="text-center">
                    <div class="widget-heading"><?php echo $user ->datetime; ?></div>       
                </td>
                <td class="text-center"><?php echo $user ->reportType; ?></td>
                <td class="text-center"><?php echo $user ->disposeType; ?></td>
                <td class="text-center"><?php echo $user ->disposeName; ?></td>
                <td class="text-center"><?php echo $user ->callDuration; ?></td>
                <td class="text-center"><?php echo $user ->agentName; ?></td>
                <td class="text-center"><?php echo $user ->campaignName; ?></td>
                <td class="text-center"><?php echo $user ->processName; ?></td>
                <td class="text-center"><?php echo $user ->leadsetId; ?></td>
                <td class="text-center"><?php echo $user ->referenceUuid; ?></td>
                <td class="text-center"><?php echo $user ->customerUuid; ?></td>
                <td class="text-center"><?php echo $user ->hold; ?></td>
                <td class="text-center"><?php echo $user ->mute; ?></td>
                <td class="text-center"><?php echo $user ->ringing; ?></td>
                <td class="text-center"><?php echo $user ->transfer; ?></td>
                <td class="text-center"><?php echo $user ->conference; ?></td>
                <td class="text-center"><?php echo $user ->callTime; ?></td>
                <td class="text-center"><?php echo $user ->disposeTime; ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="19" class="text-center">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

