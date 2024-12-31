<table class="align-middle mb-0 table table-borderless table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($accessUser) && !empty($accessUser)): ?>
            <?php foreach ($accessUser as $user): ?>
            <tr>
                <td class="text-center text-muted">#<?= $user->id; ?></td>
                <td class="text-center">
                    <div class="widget-heading"><?= esc($user->firstname); ?></div>
                </td>
                <td class="text-center"><?= esc($user->email); ?></td>
                <td class="text-center">
                    <div class="badge <?= ($user->access_level == 1 || $user->access_level == 3) ? 'badge-info' : 'badge-warning'; ?>"><?= esc($user->role); ?></div>
                </td>
                <td class="text-center">
                    <a style="background-color: #A8CD89" class="text-center btn btn-success edit" href="#ex2" rel="modal:open">Edit <i class="ri-edit-line"></i></a>
                    <a data-id="<?= $user->id; ?>" style="background-color:rgb(153, 48, 48)" class="text-center btn btn-danger delete" href="#ex3" rel="modal:open">Delete <i class="ri-chat-delete-line"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No users found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
