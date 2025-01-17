<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Logger Reports
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="btn btn-focus <?php if($current_page == 'loggerReport1.php') echo 'active'; ?>" onclick="window.location.href = '/loggerReports/1'">SQL Report</button>
                        <button class="btn btn-focus <?php if($current_page == 'loggerReport2.php') echo 'active'; ?>" onclick="window.location.href = '/loggerReports/2'">MongoDB Report</button>
                        <button class="btn btn-focus <?php if($current_page == 'loggerReport3.php') echo 'active'; ?>" onclick="window.location.href = '/loggerReports/3'">Elastic Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="table-responsive">
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead style="background-color:#c7c7c7">
            <tr>
                <!-- <th class="text-center col-sm-4">Id</th> -->
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
            if (isset($pagedata['accessUser'])) {
                foreach ($pagedata['accessUser'] as $user) {
            ?>
            <tr>
                <td class="text-center">
                            <div class="widget-heading"><?php echo $user->datetime; ?></div>       
                        </td>
                        <td class="text-center"><?php echo  $user->reportType; ?></td>
                        <td class="text-center"><?php echo  $user->disposeType; ?></td>
                        <td class="text-center"><?php echo  $user->disposeName; ?></td>
                        <td class="text-center"><?php echo  $user->callDuration; ?></td>
                        <td class="text-center"><?php echo  $user->agentName; ?></td>
                        <td class="text-center"><?php echo  $user->campaignName; ?></td>
                        <td class="text-center"><?php echo  $user->processName; ?></td>
                        <td class="text-center"><?php echo  $user->leadsetId; ?></td>
                        <td class="text-center"><?php echo  $user->referenceUuid; ?></td>
                        <td class="text-center"><?php echo  $user->customerUuid; ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->hold); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->mute); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->ringing); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->transfer); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->conference); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->callTime); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->disposeTime); ?></td>
                
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="19" class="text-center">No data available</td></tr>';
            }
            ?>

            <?php if($reportNumber == 3) {?>
                <tr>
                <td class="text-center">
                            <div class="widget-heading"><?php echo $user->datetime; ?></div>       
                        </td>
                        <td class="text-center"><?php echo  $user->reportType; ?></td>
                        <td class="text-center"><?php echo  $user->disposeType; ?></td>
                        <td class="text-center"><?php echo  $user->disposeName; ?></td>
                        <td class="text-center"><?php echo  $user->callDuration; ?></td>
                        <td class="text-center"><?php echo  $user->agentName; ?></td>
                        <td class="text-center"><?php echo  $user->campaignName; ?></td>
                        <td class="text-center"><?php echo  $user->processName; ?></td>
                        <td class="text-center"><?php echo  $user->leadsetId; ?></td>
                        <td class="text-center"><?php echo  $user->referenceUuid; ?></td>
                        <td class="text-center"><?php echo  $user->customerUuid; ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->hold); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->mute); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->ringing); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->transfer); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->conference); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->callTime); ?></td>
                        <td class="text-center"><?php echo gmdate('H:i:s',$user->disposeTime); ?></td>
                
            </tr>
            <?php }?>
        </tbody>
    </table>

<div class="d-block text-center card-footer">
        <?php if($reportNumber == 1){?>
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/1')?>" rel="modal:open">Download Logger Report <i class="ri-chat-search-line"></i></a>
        <?php } else if($reportNumber == 2){?>
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/2')?>" rel="modal:open">Download Logger Report <i class="ri-chat-search-line"></i></a>
        <?php } else {?>
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/3')?>" rel="modal:open">Download Logger Report <i class="ri-chat-search-line"></i></a>
        <?php }?>

        <a style="background-color:rgb(175, 255, 218)" class="text-center btn" href="#filterReport" rel="modal:open">Filter <i class="ri-chat-search-line"></i></a>
    </div>
    <div class="pager"><?= $pagedata['pager'] ?></div>
</div>

<div id="filterReport" class="modal">
    <?php if($reportNumber == 1) {?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/1"); ?>" method="get">
    <?php } else if($reportNumber == 2) {?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/2"); ?>" method="get">
    <?php }else{?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/3"); ?>" method="get">
    <?php }?>
        <div class="modal-header" style="background-color:rgb(255, 235, 123);">                      
            <h4 class="modal-title">Filter Users</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Report Type</label>
                <select class="custom-select" name="report" id="reportFilter">
                    <option value="default" disabled>Select Report Type</option>
                    <option value="disposed" <?= ($user->reportType == 'disposed') ? 'selected' : '' ?>>Dispose</option>
                    <option value="missed" <?= ($user->reportType == 'missed') ? 'selected' : '' ?>>Missed</option>
                    <option value="autoDrop" <?= ($user->reportType == 'autoDrop') ? 'selected' : '' ?>>Auto Drop</option>
                    <option value="autoFail" <?= ($user->reportType == 'autoFail') ? 'selected' : '' ?>>Auto Fail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Dispose Type</label>
                <select class="custom-select" name="dispose" id="disposeFilter">
                    <option value="" disabled>Select Dispose Type</option>
                    <option value="callback" <?= ($user->disposeType == 'callback') ? 'selected' : '' ?>>Call Back</option>
                    <option value="dnc" <?= ($user->disposeType == 'dnc') ? 'selected' : '' ?>>Dnc</option>
                    <option value="etx" <?= ($user->disposeType == 'etx') ? 'selected' : '' ?>>Etx</option>
                </select>
            </div>
            <div class="form-group">
                <label>Search</label>
                <input type="text" class="form-control" name="search" id="searchFilter" placeholder="Search by Campaign Name or Agent Name or Process Name">
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-secondary " id="closeFilter" rel="modal:close">Close</a>
            <input type="submit" class="btn btn-info filter" name="filter" value="Filter">
            <input type="button" class="btn btn-danger reset" value="Reset" onclick="resetFilters()">
        </div>
    </form>
</div>

<script> 
function resetFilters() { 
    document.getElementById('reportFilter').value = "default"; 
    document.getElementById('disposeFilter').value = ""; 
    document.getElementById('searchFilter').value = ''; 
    document.getElementById('filterForm').submit(); 
    } 
</script>








   



