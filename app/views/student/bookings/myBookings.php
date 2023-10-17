<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/student_navbar.php'; ?>
<main class="bg-light rounded-2 p-3">
    <?php flash('booking_success'); ?>
    <?php flash('booking_cancel_success'); ?>
    <?php flash('booking_cancel_fail'); ?>
    <h2 class="bg-light p-3 rounded-1">My bookings</h2>
    <div class="p-3 table-responsive bg-light rounded-2">
        <table id="bookings" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">LAB NAME</th>
                    <th scope="col">START DATE</th>
                    <th scope="col">END DATE</th>
                    <th scope="col">START TIME</th>
                    <th scope="col">END TIME</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $bookings) : ?>
                    <?php
                    $bookings->start_time = date("g:i A", strtotime($bookings->start_time));
                    $bookings->end_time = date("g:i A", strtotime($bookings->end_time));
                    ?>
                    <!-- Modal for cancel bookings -->
                    <div class="modal fade" id="cancel<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cancel confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Proceed to cancel this booking?
                                </div>
                                <div class="modal-footer">
                                    <button onclick="location.href='<?php echo URLROOT; ?>/students/cancelBooking/<?php echo $bookings->booking_id; ?>'" type="button" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td><?php echo $bookings->booking_id; ?></td>
                        <td><?php echo $bookings->lab_code; ?></td>
                        <td><?php echo $bookings->start_date; ?></td>
                        <td><?php echo $bookings->end_date; ?></td>
                        <td><?php echo $bookings->start_time; ?></td>
                        <td><?php echo $bookings->end_time; ?></td>
                        <td>
                            <?php if ($bookings->status == 'pending') : ?>
                                <span class="badge rounded-pill text-bg-secondary"><?php echo $bookings->status; ?></span>
                            <?php elseif ($bookings->status == 'booked') : ?>
                                <span class="badge rounded-pill text-bg-success"><?php echo $bookings->status; ?></span>
                            <?php elseif ($bookings->status == 'cancelled') : ?>
                                <span class="badge rounded-pill text-bg-danger"><?php echo $bookings->status; ?></span>
                            <?php elseif ($bookings->status == 'rejected') : ?>
                                <span class="badge rounded-pill text-bg-danger"><?php echo $bookings->status; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($bookings->status == 'pending') : ?>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $bookings->booking_id; ?>" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can"></i> cancel</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#bookings').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>