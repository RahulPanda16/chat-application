<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Summary Reports
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                    <button class="btn btn-focus active <?php if($current_page == 'loggerReport1.php') echo 'active'; ?>" onclick="window.location.href = '/summaryReports/1'">SQL Report</button>
                        <button class="btn btn-focus <?php if($current_page == 'loggerReport2.php') echo 'active'; ?>" onclick="window.location.href = '/summaryReports/2'">MongoDB Report</button>
                        <button class="btn btn-focus <?php if($current_page == 'loggerReport3.php') echo 'active'; ?>" onclick="window.location.href = '/summaryReports/3'">Elastic Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<!--  -->
<div class="table-responsive">

    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        
        <thead style="background-color:#c7c7c7">
        <?php if($reportNumber == 1) { ?>
                <tr>
                    <!-- <th class="text-center col-sm-2">Campaign Name</th> -->
                    <th class="text-center col-sm-2">Call Hours</th>
                    <th class="text-center col-sm-2">Date Time</th>
                    <th class="text-center col-sm-2">Total Calls</th>
                    <th class="text-center col-sm-2">Call Answered</th>
                    <th class="text-center col-sm-2">Missed Call</th>
                    <th class="text-center col-sm-2">Call Autodrop</th>
                    <th class="text-center col-sm-2">Call Autofail</th>
                    <th class="text-center col-sm-4">TalkTime</th>
                </tr>
                </thead>
        <tbody>
            <?php 
            if (isset($pagedata['accessUser'])) {
                foreach ($pagedata['accessUser'] as $data) {
            ?>
            <tr>
                <td class="text-center"><?php echo $data -> Call_hours; ?></td>
                <td class="text-center"><?php echo $data -> datetime; ?></td>
                <td class="text-center"><?php echo $data -> Total_Calls; ?></td>
                <td class="text-center"><?php echo $data -> Call_Answered; ?></td>
                <td class="text-center"><?php echo $data -> Missed_Calls; ?></td>
                <td class="text-center"><?php echo $data -> Call_Autodrop; ?></td>
                <td class="text-center"><?php echo $data -> Call_Autofail; ?></td>
                <td class="text-center"><?php echo gmdate('H:i:s',$data ->Talktime) ; ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="19" class="text-center">No data available</td></tr>';
            }
            ?>
        </tbody>
            <?php } else {?>

            <tr>
                <th class="text-center col-sm-1">Call Hours</th>
                <th class="text-center col-sm-2">Total Talk Time</th>
                <th class="text-center col-sm-1">Total Calls </th>
                <th class="text-center col-sm-1">Call Answered</th>
                <th class="text-center col-sm-1">Missed Call</th>
                <th class="text-center col-sm-1">Call Autodrop</th>
                <?php if($reportNumber == 2) {?>
                    <th class="text-center col-sm-1">Call Autofail</th>
                    <?php }?>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($pagedata['accessUser'])) {
                foreach ($pagedata['accessUser'] as $user) {
            ?>
            <tr>
                <?php if($reportNumber == 2) { ?>
                <td class="text-center">
                    <div class="widget-heading"><?php echo $user -> _id; ?></div>       
                </td>
                <td class="text-center"><?php echo gmdate('H:i:s',$user ->Talktime) ; ?></td>
                <td class="text-center"><?php echo $user -> Total_Calls; ?></td>
                <td class="text-center"><?php echo $user -> Call_Answered; ?></td>
                <td class="text-center"><?php echo $user -> Missed_Calls; ?></td>
                <td class="text-center"><?php echo $user -> Call_Autodrop; ?></td>
                <td class="text-center"><?php echo $user -> Call_Autofail; ?></td>
                <?php } else { ?>
                <td class="text-center"><?php echo $user -> Talktime; ?></td>
                <td class="text-center"><?php echo $user -> Total_Calls ; ?></td>
                <td class="text-center"><?php echo $user -> Call_Answered ; ?></td>
                <td class="text-center"><?php echo $user -> Missed_Calls; ?></td>
                <td class="text-center"><?php echo $user -> Call_Autodrop; ?></td>
                <td class="text-center"><?php echo $user -> Call_Autofail; ?></td>
                    <?php } ?>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="19" class="text-center">No data available</td></tr>';
            }
            ?>
        </tbody>
        <?php } ?>
    </table>
    <div class="d-block text-center card-footer">
        <?php if($reportNumber == 1){?>
             <a style="background-color: #A8CD89" class="text-center btn btn-success" href="<?php echo base_url('/getsummaryreport/1')?>">Download Summarize Report <i class="ri-chat-new-line"></i></a>
        <?php } else if($reportNumber == 2){?>
            <a style="background-color: #A8CD89" class="text-center btn btn-success" href="<?php echo base_url('/getsummaryreport/2')?>">Download Summarize Report <i class="ri-chat-new-line"></i></a>
        <?php } else {?>
            <a style="background-color: #A8CD89" class="text-center btn btn-success" href="<?php echo base_url('/getsummaryreport/3')?>">Download Summarize Report <i class="ri-chat-new-line"></i></a>
        <?php }?>
    </div>
    <div class="pager"><?= $pagedata['pager'] ?></div>
</div>

