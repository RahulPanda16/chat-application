<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Logger Reports
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="btn btn-focus inline-flex items-center px-3 py-2 text-white bg-black-500 rounded-lg w-full dark:bg-blue-600 <?php if($current_page == 1) echo 'active'; ?>" onclick="window.location.href = '/loggerReports/1'">SQL Report</button>
                        <button class="btn btn-focus <?php if($current_page == 2) echo 'active'; ?>" onclick="window.location.href = '/loggerReports/2'">MongoDB Report</button>
                        <button class="btn btn-focus <?php if($current_page == 3) echo 'active'; ?>" onclick="window.location.href = '/loggerReports/3'">Elastic Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="table-responsive relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="align-middle mb-0 table table-borderless table-striped table-hover w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead style="background-color:#c7c7c7" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <!-- <th class="text-center col-sm-4">Id</th> -->
                <th class="text-center  px-6 py-3" scope="col">Date Time</th>
                <th class="text-center px-6 py-3">Report Type</th>
                <th class="text-center px-6 py-3">Dispose Type</th>
                <th class="text-center px-6 py-3">Dispose Name</th>
                <th class="text-center px-6 py-3">Call Duration</th>
                <th class="text-center px-6 py-3">Agent Name</th>
                <th class="text-center px-6 py-3">Campaign Name</th>
                <th class="text-center px-6 py-3">Process Name</th>
                <th class="text-center px-6 py-3">Leadset Id</th>
                <th class="text-center px-6 py-3">Reference Uuid</th>
                <th class="text-center px-6 py-3">Customer Uuid</th>
                <th class="text-center px-6 py-3">Hold Time</th>
                <th class="text-center px-6 py-3">Mute Time</th>
                <th class="text-center px-6 py-3">Ringing Time</th>
                <th class="text-center px-6 py-3">Transfer Time</th>
                <th class="text-center px-6 py-3">Conference Time</th>
                <th class="text-center px-6 py-3">Call Time</th>
                <th class="text-center px-6 py-3">Dispose Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($pagedata['accessUser'])) {
                foreach ($pagedata['accessUser'] as $user) {
            ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="widget-heading"><?php echo $user->datetime; ?></div>       
                        </td>
                        <td class="text-center px-6 py-3"><?php echo  $user->reportType; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->disposeType; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->disposeName; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->callDuration; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->agentName; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->campaignName; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->processName; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->leadsetId; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->referenceUuid; ?></td>
                        <td class="text-center px-6 py-3"><?php echo  $user->customerUuid; ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->hold); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->mute); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->ringing); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->transfer); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->conference); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->callTime); ?></td>
                        <td class="text-center px-6 py-3"><?php echo gmdate('H:i:s',$user->disposeTime); ?></td>
                
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
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/1')?>" rel="modal:open">Download Logger Report <i class="ri-file-download-line"></i></a>
        <?php } else if($reportNumber == 2){?>
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/2')?>" rel="modal:open">Download Logger Report <i class="ri-file-download-line"></i></a>
        <?php } else {?>
            <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="<?php echo base_url('/getLoggerReport/3')?>" rel="modal:open">Download Logger Report <i class="ri-file-download-line"></i></a>
        <?php }?>

        <a style="background-color:rgb(175, 255, 218)" class="text-center btn" href="#filterReport" rel="modal:open">Filter <i class="ri-chat-search-line"></i></a>
    </div>
    <div class="pager"><?= $pagedata['pager'] ?></div>
</div>

<div id="filterReport" class="modal ">
    <?php if($reportNumber == 1) {?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/1"); ?>" method="get">
    <?php } else if($reportNumber == 2) {?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/2"); ?>" method="get">
    <?php }else{?>
        <form id="filterForm" action="<?php echo base_url("/loggerReports/3"); ?>" method="get">
    <?php }?>
        <div class="modal-header flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600" style="background-color:rgb(255, 235, 123);">                      
            <h4 class="modal-title text-lg font-semibold text-gray-900 dark:text-white">Filter Users</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Report Type</label>
                <select class="custom-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="report" id="reportFilter">
                    <option value="" selected="" default >Select Report Type</option>
                    <option value="disposed" <?= ($user->reportType == 'disposed') ? 'selected' : '' ?>>Dispose</option>
                    <option value="missed" <?= ($user->reportType == 'missed') ? 'selected' : '' ?>>Missed</option>
                    <option value="autoDrop" <?= ($user->reportType == 'autoDrop') ? 'selected' : '' ?>>Auto Drop</option>
                    <option value="autoFail" <?= ($user->reportType == 'autoFail') ? 'selected' : '' ?>>Auto Fail</option>
                </select>
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dispose Type</label>
                <select class="custom-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="dispose" id="disposeFilter">
                    <option value="" selected="" default >Select Dispose Type</option>
                    <option value="callback" <?= ($user->disposeType == 'callback') ? 'selected' : '' ?>>Call Back</option>
                    <option value="dnc" <?= ($user->disposeType == 'dnc') ? 'selected' : '' ?>>Dnc</option>
                    <option value="etx" <?= ($user->disposeType == 'etx') ? 'selected' : '' ?>>Etx</option>
                </select>
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search</label>
                <input type="text" class="form-controlbg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="search" id="searchFilter" placeholder="Search by Campaign Name or Agent Name or Process Name">
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
    document.getElementById('reportFilter').value = ""; 
    document.getElementById('disposeFilter').value = ""; 
    document.getElementById('searchFilter').value = ''; 
    document.getElementById('filterForm').submit(); 
    } 
</script>








   



