<!-- <script>
    $(document).ready(function() {
        $(document).on('click', '.editCampaign', function() {
        // var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim();
        var id = $(this).closest('tr').find('input[name="id"]').val();
        console.log(id);
        $.ajax({
            url: "<?php echo base_url(); ?>"+"/getSingleCampaign/" + id,
            method: "GET",
            success: function(result) {
                var res = JSON.parse(result);
                console.log(res);
                $(".updateId").val(res.id);
                $(".updateName").val(res.name);
                $(".updateDescription").val(res.description);
                $(".updateClient").val(res.client);
                $(".updateSupervisor").val(res.supervisor);
                $(".updateState").val(res.state);
                // $("#ex2").modal('show'); 
                console.log(res);
            }
            // error: function(xhr, status, error) {
            //     console.error("Error fetching user data: ", error);
            //     alert("Failed to fetch user data. Please try again.");
            // }
        });
    });

    $(document).on('click', '.deleteCampaign', function() {
        // var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim();
        var id = $(this).closest('tr').find('input[name="id"]').val();
        $('#confirmYes').data('id', id); 
        // $('#ex3').modal('show');
    });

    $('#confirmCampaignYes').on('click', function() {
        var id = $(this).data('id'); 
        $.ajax({
            url: "<?php echo base_url(); ?>/deleteCampaign ", 
            method: "POST",
            data: { id: id },
            success: function(response) {
                console.log(response);
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});
</script> -->

<script>
$(document).ready(function() {
    $(document).on('click', '.editCampaign', function() {
        var id = $(this).closest('tr').find('input[name="id"]').val();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/getSingleCampaign/" + id,
            method: "GET",
            success: function(result) {
                var res = JSON.parse(result);
                console.log(res);
                $(".updateId").val(res.id);
                $(".updateName").val(res.name);
                $(".updateDescription").val(res.description);
                $(".updateClient").val(res.client);
                $(".updateSupervisor").val(res.supervisor);
                $(".updateState").val(res.state);
            }
        });
    });

    $(document).on('click', '.deleteCampaign', function() {
        var id = $(this).closest('tr').find('input[name="id"]').val();
        $('#confirmCampaignYes').data('id', id);
    });

    $('#confirmCampaignYes').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url(); ?>/deleteCampaign",
            method: "POST",
            data: { id: id },
            success: function(response) {
                if(response.includes("deleted")){
                    location.reload();
                } else {
                    alert("Failed to delete campaign.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<div id="ex4" class="modal modal1">				
            <form action = "<?php echo base_url().'saveCampaign'; ?>" method = "POST" >
				<div class="modal-header" style="background-color: #81BFDA;">						
					<h4 class="modal-title">Add Campaign</h4>
				</div>
				<div class="modal-body">
					<?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" required>
					</div>
                    <div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" name="description" required>
					</div>
					<div class="form-group">
						<label>Client</label>
						<input type="text" class="form-control" name="client" required>
					</div>
                    <div class="form-group">
                        <label>Supervisor</label>
                        <input type="text" class="form-control" name="supervisor" required>
					</div>
                    <div class="form-group">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">State</label>
                            <select class="custom-select my-1 mr-sm-2 state" name="state" id="inlineFormCustomSelectPref" required>
                              <option selected>Choose...</option>
                              <option value="0">Not Active</option>
                              <option value="1">Active</option>
                            </select>
					</div>				
				</div>
				<div class="modal-footer">
                    <a href="#" class="btn btn-success" rel="modal:close">Cancel</a>
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
</div>


<!-- <div id="ex5" class="modal modal2">
    <form action = "<?php echo base_url().'updateCampaign'; ?>" method = "POST">
		<div class="modal-header" style="background-color:#FBB4A5">						
			<h4 class="modal-title">Edit Employee</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
            <input type="hidden" name="id" class = "updateId" >	
            <div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control updateName" name="name" required>
			</div>
            <div class="form-group">
				<label>Description</label>
				<input type="text" class="form-control updateDescription" name="description" required>
			</div>
            <div class="form-group">
				<label>Client</label>
				<input type="text" class="form-control updateClient" name="client" required>
			</div>
			<div class="form-group">
				<label>Supervisor</label>
				<input type="text" class="form-control updateSupervisor" name="supervisor" required>
			</div>
            <div class="form-group">
                <label class="my-1 mr-2 " for="inlineFormCustomSelectPref">State</label>
                    <select class=" updateState custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                      <option selected disabled>Choose...</option>
                      <option value="1">Active</option>
                      <option value="2">Not Active</option>
                    </select>
			</div>				
				</div>
				<div class="modal-footer">
                    <a href="#" name="submit" type="button" class="btn btn-default" rel="modal:close">Cancel</a>
					<input type="submit" class="btn btn-info" value="Save">
				</div>
	</form>
</div> -->

<div id="ex5" class="modal modal2">
    <form action="<?php echo base_url().'updateCampaign'; ?>" method="POST">
        <div class="modal-header" style="background-color:#FBB4A5">                     
            <h4 class="modal-title">Edit Campaign</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" class="updateId">    
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control updateName" name="name" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control updateDescription" name="description" required>
            </div>
            <div class="form-group">
                <label>Client</label>
                <input type="text" class="form-control updateClient" name="client" required>
            </div>
            <div class="form-group">
                <label>Supervisor</label>
                <input type="text" class="form-control updateSupervisor" name="supervisor" required>
            </div>
            <div class="form-group">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">State</label>
                <select class="updateState custom-select my-1 mr-sm-2" name="state" id="inlineFormCustomSelectPref">
                    <option selected disabled>Choose...</option>
                    <option value="0">Not Active</option>
                    <option value="1">Active</option>
                </select>
            </div>              
        </div>
        <div class="modal-footer">
            <a href="#" name="submit" type="button" class="btn btn-default" rel="modal:close">Cancel</a>
            <input type="submit" class="btn btn-info" value="Save">
        </div>
    </form>
</div>

<div id="ex6" class="modal modalDeleteCampaign">
    <div class="modal-header" style="background-color: #9AA6B2;">
        <h5 class="modal-title" id="confirmModalLabel">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        Are you sure you want to delete the data?
    </div>
    <div class="modal-footer">
        <a href="#" name="submit" type="button" class="btn btn-default" rel="modal:close">Cancel</a>
        <button type="button" class="btn btn-primary" id="confirmCampaignYes">OK</button>
    </div>
</div>

<div id="filter2" class="modal">
    <form id="filterForm" action="<?php echo base_url(); ?>/campaign" method="get">
        <div class="modal-header" style="background-color: #FFD700;">                      
            <h4 class="modal-title">Filter Campaigns</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Status</label>
                <select class="custom-select" name="status" id="stateFilter">
                    <!-- <option value="1">Active</option>
                    <option value="2">Not Active</option> -->
                    <option value="" >All State</option>
                    <option value="0" <?= ($status == '0') ? 'selected' : '' ?>>Not Active</option>
                    <option value="1" <?= ($status == '1') ? 'selected' : '' ?>>Active</option> 
                </select>
            </div>
            <div class="form-group">
                <label>Search</label>
                <input type="text" class="form-control" name="search" id="searchFilter" placeholder="Search">
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-secondary" rel="modal:close">Close</a>
            <input type="submit" class="btn btn-info filter" name="filter" value="Filter">
        </div>
    </form>
</div>


<div class="table-responsive">
    <?php if(session()->getFlashdata("success")){ ?>
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

    <?php
        if(isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors(); ?>
            </div>
            <?php endif; ?>
                <table class="align-middle mb-0 table table-center table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Client</th>
                            <th class="text-center">Supervisor</th>
                            <th class="text-center">State</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
    <?php if (isset($campaigns) && !empty($campaigns)): ?>
        <?php foreach ($campaigns as $campaign): ?>
        <tr>
            <input type="hidden" id="campaignId" name="id" value="<?= $campaign->id; ?>" >
            <td>
                <div class="text-center widget-heading"><?= esc($campaign->name); ?></div>
            </td>
            <td class="text-center"><?= esc($campaign->description); ?></td>
            <td class="text-center"><?= esc($campaign->client); ?></td>
            <td class="text-center"><?= esc($campaign->supervisor); ?></td>
            <td class="text-center">
                <div class="badge <?= ($campaign->status == 1) ? 'badge-info' : 'badge-warning'; ?>"><?= ($campaign->status == 1) ? 'Active' : 'Not Active'; ?></div>
            </td>
            <td class="text-center">
                <a style="background-color: #A8CD89" class="text-center btn btn-success editCampaign" href="#ex5" rel="modal:open">Edit <i class="ri-edit-line"></i></a>
                <a data-id="<?= $campaign->id; ?>" style="background-color:rgb(153, 48, 48)" class="text-center btn btn-danger deleteCampaign" href="#ex6" rel="modal:open">Delete <i class="ri-chat-delete-line"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">No campaigns found.</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>                
            <div class="d-block text-center card-footer">
                <a style="background-color: #A8CD89" class="text-center btn btn-success" href="#ex4" rel="modal:open">Create <i class="ri-chat-new-line"></i></a>
                <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="#filter2" rel="modal:open">Filter <i class="ri-chat-search-line"></i></a>
            </div>
            <div class="pager"><?= $pager ?></div>
            
    </div>