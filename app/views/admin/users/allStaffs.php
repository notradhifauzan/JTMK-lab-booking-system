<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<?php flash('staff_delete_success'); ?>
<?php flash('staff_delete_fail'); ?>
<main class="bg-light rounded-2">
    <h2 class="bg-light p-3 rounded-1">Staffs</h2>
    <div class="p-3 table-responsive bg-light rounded-2">
        <table id="user-list" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">IC</th>
                    <th scope="col">NAME</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $users) : ?>
                    <!-- Modal for delete staffs -->
                    <div class="modal fade" id="delete<?php echo $users->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Proceed to delete this staff?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button onclick="location.href='<?php echo URLROOT; ?>/admins/deleteStaffs/<?php echo $users->id; ?>'" type="button" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td><?php echo $users->staff_ic; ?></td>
                        <td><?php echo $users->staff_name; ?></td>
                        <td><?php echo $users->staff_phone; ?></td>
                        <td><?php echo $users->staff_email; ?></td>
                        <td><button data-bs-toggle="modal" data-bs-target="#delete<?php echo $users->id; ?>" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#user-list').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>