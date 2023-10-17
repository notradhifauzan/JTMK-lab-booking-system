<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<?php flash('lab_delete_success'); ?>
<?php flash('lab_delete_fail'); ?>
<main class="bg-light rounded-2">
    <h2 class="bg-light p-3 rounded-1">Labs</h2>
    <div class="p-3 table-responsive bg-light rounded-2">
        <table id="labs" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">LAB ID</th>
                    <th scope="col">CODE</th>
                    <th scope="col">CAPACITY</th>
                    <th scope="col">LEVEL</th>
                    <th scope="col">FACULTY</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['labs'] as $labs) : ?>
                    <!-- Modal for delete labs -->
                    <div class="modal fade" id="delete<?php echo $labs->lab_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Proceed to delete this lab?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button onclick="location.href='<?php echo URLROOT; ?>/admins/deleteLab/<?php echo $labs->lab_id; ?>'" type="button" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td><?php echo $labs->lab_id; ?></td>
                        <td><?php echo $labs->lab_code; ?></td>
                        <td><?php echo $labs->capacity; ?></td>
                        <td><?php echo $labs->level; ?></td>
                        <td><?php echo $labs->faculty; ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button onclick="location.href='<?php echo URLROOT; ?>/admins/viewLabDetails/<?php echo $labs->lab_id; ?>'" type="button" class="btn btn-outline-secondary"><i class="fa-regular fa-pen-to-square"></i> view</button>
                                <button data-bs-toggle="modal" data-bs-target="#delete<?php echo $labs->lab_id; ?>" type="button" class="btn btn-outline-secondary"><i class="fa-regular fa-trash-can"></i> delete</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#labs').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>