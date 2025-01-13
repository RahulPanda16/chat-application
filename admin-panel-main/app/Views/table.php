<script>
$(document).ready(function() {
    $(document).on('click', '.edit', function() {
        var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim();
        $.ajax({
            url: "<?php echo base_url(); ?>"+"/getSingleUser/" + id,
            method: "GET",
            success: function(result) {
                var res = JSON.parse(result);
                $(".updateId").val(res.id);
                $(".updateFirstname").val(res.firstname);
                $(".updateLastname").val(res.lastname);
                $(".updateEmail").val(res.email);
                $("#inlineFormCustomSelectPref").val(res.access_level);
            }
        });
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim();
        $('#confirmYes').data('id', id);
    });

    $('#confirmYes').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url(); ?>/deleteUser ",
            method: "POST",
            data: { id: id },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

document.getElementById('closeFilter').addEventListener('click', function() { 
    document.getElementById('filterForm').reset(); 
});
</script>


<div id="ex1" class="modal">
    <form action = "<?php echo base_url().'/saveUser'; ?>" method = "POST" >
		<div class="modal-header" style="background-color: #81BFDA;">						
			<h4 class="modal-title">Add User</h4>
			<!-- <a type="button" rel="modal:close" class="close" data-dismiss="modal" aria-hidden="true">&times;</a> -->
		</div>
			<div class="modal-body">
				<?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>					
				<div class="form-group">
					<label>First Name</label>
					<input type="text" class="form-control" name="firstname" required>
				</div>
                <div class="form-group">
					<label>Last Name</label>
					<input type="text" class="form-control" name="lastname" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" required>
				</div>
                <div class="form-group">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Role</label>
                        <select class="custom-select my-1 mr-sm-2" name="role" id="inlineFormCustomSelectPref" required>
                          <option selected>Choose...</option>
                          <option value="1">Admin</option>
                          <option value="2">Supervisor</option>
                          <option value="3">Team Lead</option>
                          <option value="4">Agent</option>
                        </select>
				</div>				
			</div>
			<div class="modal-footer">
                <a href="#" class="btn btn-success" rel="modal:close">Close</a>
				<!-- <input type="button" class="btn btn-default" name="submit" data-dismiss="modal" value="Cancel"> -->
				<input type="submit" class="btn btn-success" value="Add">
			</div>
	</form>
  <!-- <a href="#" rel="modal:close">Close</a> -->
</div>

<div id="ex2" class="modal">
    <form action = "<?php echo base_url().'/updateUser'; ?>" method = "POST">
        <div class="modal-header" style="background-color:#FBB4A5">                     
            <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="updateId" class="updateId">  
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control updateFirstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control updateLastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control updateEmail" name="email" required>
            </div>
            <div class="form-group">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Role</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="role">
                    <option selected disabled>Choose...</option>
                    <option value="1">Admin</option>
                    <option value="2">Supervisor</option>
                    <option value="3">Team Lead</option>
                    <option value="4">Agent</option>
                </select>
            </div>              
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-default" rel="modal:close">Close</a>
            <input type="submit" class="btn btn-info" value="Save">
        </div>
    </form>
</div>

<div id="ex3" class="modal modalDeleteUser">
    <div class="modal-header" style="background-color: #9AA6B2;">
        <h5 class="modal-title" id="confirmModalLabel">Confirm </h5>
    </div>
    <div class="modal-body">
        Are you sure you want to delete the data?
    </div>
    <div class="modal-footer">
        <a href="#" type="button" class="btn btn-secondary" rel="modal:close">Cancel</a>
        <button type="button" class="btn btn-primary" id="confirmYes">OK</button>
    </div>
</div>

<div id="filter1" class="modal">
    <form id="filterForm" action="<?php echo base_url(); ?>" method="get">
        <div class="modal-header" style="background-color: #FFD700;">                      
            <h4 class="modal-title">Filter Users</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Role</label>
                <select class="custom-select" name="role" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="1" <?= ($accessLevel == '1') ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= ($accessLevel == '2') ? 'selected' : '' ?>>Supervisor</option>
                    <option value="3" <?= ($accessLevel == '3') ? 'selected' : '' ?>>Team Lead</option>
                    <option value="4" <?= ($accessLevel == '4') ? 'selected' : '' ?>>Agent</option>
                </select>
            </div>
            <div class="form-group">
                <label>Search</label>
                <input type="text" class="form-control" name="search" id="searchFilter" placeholder="Search by name or email">
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-secondary " id="closeFilter" rel="modal:close">Close</a>
            <input type="submit" class="btn btn-info filter" name="filter" value="Filter">
        </div>
    </form>
</div>


              
<!-- Link to open the modal -->
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Active Agents
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="active btn btn-focus">Last Week</button>
                        <button class="btn btn-focus">All Month</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
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

		<?php
		if (session()->getFlashdata("fail")) {
		?>
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
<table class="align-middle mb-0 table table-borderless table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <!-- <th class="text-center">State</th> -->
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
                    
    <?php 
    if(isset($accessUser)) 
            foreach($accessUser as $user){
    ?>
    <tr>
        <td class="text-center text-muted">#<?php echo $user->id; ?></td>
        <td class="text-center">
            <div class="widget-heading"><?php echo $user->firstname; ?></div>
            <!-- <div class="widget-heading"><?php echo $user->lastname; ?></div> -->
            
        </td>
        <td class="text-center"><?php echo $user->email; ?></td>
        <td class="text-center">
            <div class="badge <?php echo ($user->access_level == 1 || $user->access_level == 3)? 'badge-info' : 'badge-warning';  ?>"><?php echo $user->access_level; ?></div>
        </td>
       
        <td class="text-center">
        <a style="background-color: #A8CD89" class="text-center btn btn-success edit" href="#ex2" rel="modal:open">Edit <i class="ri-edit-line"></i></a>
            <!-- <a href="#editUser" data-target="#editUser" class="btn btn-success edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a> -->
            <!-- <a href="#" class="btn btn-danger delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a> -->
            <a style="background-color:rgb(153, 48, 48)" class="text-center btn btn-danger delete" href="#ex3" rel="modal:open">Delete <i class="ri-chat-delete-line"></i></a>
        </td>
    </tr>
        
        <?php
            }
        
        ?>
    </tbody>
</table>

                
<div class="d-block text-center card-footer">
    <a style="background-color: #A8CD89" class="text-center btn btn-success" href="#ex1" rel="modal:open">Create <i class="ri-chat-new-line"></i></a>
    <a style="background-color:rgb(98, 207, 156)" class="text-center btn" href="#filter1" rel="modal:open">Filter <i class="ri-chat-search-line"></i></a>
</div>
<div class="pager"><?= $pager ?></div>
                
</div>


