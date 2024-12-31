<script> 
$(document).ready(function() { 
    $(document).on('click', '.editRole', function() { 
        var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim(); 
        // var id = $(this).closest('tr').find('.roleId').val
        console.log(id);
        $.ajax({ 
            url: "<?php echo base_url(); ?>" + "/getSingleCampaign/" + id, 
            method: "GET", 
            success: function(result) { 
                var res = JSON.parse(result); 
                $(".updateId").val(res.id); 
                $("#inlineFormCustomSelectPref").val(res.role);
             } 
            });
         }); 
         
    $(document).on('click', '.deleteRole', function() { 
        var id = $(this).closest('tr').find('td.text-center.text-muted').text().replace('#', '').trim(); 
        // var id = $(this).closest('tr').find('.roleId').val
        console.log(id)
        $('#confirmRoleYes').data('id', id); }); 
        $('#confirmRoleYes').on('click', function() { 
            var id = $(this).data('id'); $.ajax({ url: "<?php echo base_url(); ?>/deleteRole", 
                method: "POST", 
                data: { id: id }, 
                success: function(response) { 
                    if (response.includes("deleted")) { 
                        location.reload(); 
                    } 
                    else { 
                        alert("Failed to delete role."); 
                    } 
                }, 
                error: function(xhr, status, error) { 
                    console.error(xhr.responseText); 
                } 
            }); 
        });
    });
</script>
<!-- <script>
$(document).ready(function() {
    $(document).on('click', '.editRole', function() {
        var id = $(this).closest('tr').find('.roleId').val();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/getSingleRole/" + id,
            method: "GET",
            success: function(result) {
                var res = JSON.parse(result);
                $(".updateId").val(res.id);
                $("#inlineFormCustomSelectPref").val(res.role);
            }
        });
    });

    $(document).on('click', '.deleteRole', function() {
        var id = $(this).closest('tr').find('.roleId').val();
        $('#confirmRoleYes').data('id', id);
    });

    $('#confirmRoleYes').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url(); ?>/deleteRole",
            method: "POST",
            data: { id: id },
            success: function(response) {
                if (response.includes("deleted")) {
                    location.reload();
                } else {
                    alert("Failed to delete role.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script> -->


<div id="ex7" class="modal modalRole"> 
    <form action="<?php echo base_url().'addRole'; ?>" method="POST"> 
        <div class="modal-header" style="background-color: #81BFDA;"> 
            <h4 class="modal-title">Add Role</h4> 
        </div> 
        <div class="modal-body"> <?php if (isset($validation)): ?> 
            <div class="alert alert-danger"> <?= $validation->listErrors(); ?> 
        </div> 
        <?php endif; ?> 
        <div class="form-group"> 
            <label>Role</label> 
            <input type="text" class="form-control" name="role" required> 
        </div> 
    </div> 
    
    <div class="modal-footer">
        <a href="#" class="btn btn-default" name="submit" type="button" rel="modal:close">Cancel</a> 
		<input type="submit" class="btn btn-success" value="Add">
    </div>
</form>
</div>
                    
                
<div id="ex8" class="modal modalRole">
    <form action="<?php echo base_url().'updateRole'; ?>" method="POST">
        <div class="modal-header" style="background-color:#FBB4A5">                     
            <h4 class="modal-title">Edit Role</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="updateId" class="updateId">  
            <div class="form-group">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Role</label>
                <select class="custom-select my-1 mr-sm-2" name="role" id="inlineFormCustomSelectPref">
                    <option selected>Choose...</option>
                    <option value="Admin">Admin</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Team Lead">Team Lead</option>
                    <option value="Agent">Agent</option>
                </select>
            </div>              
        </div>
        <div class="modal-footer">
            <a href="#" type="button" class="btn btn-default" rel="modal:close">Cancel</a>
            <input type="submit" class="btn btn-info" value="Save">
        </div>
    </form>  
</div>


<div id="ex9" class="modal modalRole">
    <div class="modal-content">
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
            <a href="#" class="btn btn-secondary" type="button" rel="modal:close">Cancel</a>
            <button type="button" class="btn btn-primary" id="confirmRoleYes">OK</button>
        </div>
    </div>
</div>


<div class="table-responsive">
    <?php if(session()->getFlashdata("success")): ?>
        <div class="alert w-50 align-self-center alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata("success"); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata("fail")): ?>
        <div class="alert w-50 align-self-center alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata("fail"); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Role</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($roles)): ?>
                <?php foreach($roles as $role): ?>
                    <tr class="text-center">
                        <input type="hidden" class="roleId" value="<?php echo $role['id']; ?>">
                        <td class="text-center text-muted">#<?php echo $role['id']; ?></td>
                        <td>
                            <div class="widget-heading"><?php echo $role['role']; ?></div>
                        </td>
                        <td class="text-center">
                            <a style="background-color: #A8CD89" class="text-center btn btn-success editRole" href="#ex8" rel="modal:open">Edit <i class="ri-edit-line"></i></a>
                            <a style="background-color:rgb(153, 48, 48)" class="text-center btn btn-danger deleteRole" href="#ex9" rel="modal:open">Delete <i class="ri-chat-delete-line"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

                                        
                                            <!-- <td>
                                                <div class="widget-heading"><?php echo $role['role']; ?></div>
                                            </td> -->
                                           

    <div class="text-center card-footer">
        <p><a style="background-color: #A8CD89" class="text-center btn btn-success" href="#ex7" rel="modal:open">Create <i class="ri-chat-new-line"></i></a></p>
    </div>
</div>
