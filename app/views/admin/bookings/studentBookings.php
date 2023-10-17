<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<main class="bg-light rounded-2 p-3">
    <?php flash('booking_approve_success'); ?>
    <?php flash('booking_approve_fail'); ?>
    <?php flash('booking_reject_success'); ?>
    <?php flash('booking_reject_fail'); ?>
    <h2>Student Bookings</h2>
    <div class="table-responsive">
        <table id="bookings" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student</th>
                    <th scope="col">Selected lab</th>
                    <th scope="col">Start date</th>
                    <th scope="col">End date</th>
                    <th scope="col">Start time</th>
                    <th scope="col">End time</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Supervisor</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $bookings) : ?>
                    <?php
                    $bookings->start_time = date("g:i A", strtotime($bookings->start_time));
                    $bookings->end_time = date("g:i A", strtotime($bookings->end_time));
                    ?>

                    <!-- modal to reject booking -->
                    <div class="modal fade" id="reject<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reject confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Proceed to reject this booking?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button onclick="location.href='<?php echo URLROOT; ?>/admins/rejectBooking/<?php echo $bookings->booking_id; ?>'" type="button" class="btn btn-outline-danger">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->

                    <!-- modal to approve booking -->
                    <div class="modal fade" id="accept<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Approve confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Proceed to approve this booking?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button onclick="location.href='<?php echo URLROOT; ?>/admins/approveBooking/<?php echo $bookings->booking_id; ?>'" type="button" class="btn btn-outline-success">Approve</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->

                    <!-- modal to view user details -->
                    <div class="modal fade" id="user<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Student details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="name" class="form-label">Student name</label>
                                            <input disabled type="text" class="form-control" placeholder="" value="<?php echo $bookings->stud_name ?>">
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="nric" class="form-label">Student ID</label>
                                            <input disabled type="text" class="form-control" placeholder="" value="<?php echo $bookings->matric_id ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input disabled type="text" class="form-control" value="<?php echo $bookings->stud_phone; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input disabled type="email" class="form-control" placeholder="" value="<?php echo $bookings->stud_email; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->

                    <!-- modal to view selected lab details -->
                    <div class="modal fade" id="lab<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selected lab</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card shadow-sm">
                                        <img class="bd-placeholder-img card-img-top" src="<?php echo URLROOT; ?>/img/backgrounds/computer_lab1.jpg" width="100%" height="225" alt="">
                                        <div class="card-body text-center">
                                            <h1 class="card-title pricing-card-title"><?php echo $bookings->lab_code; ?></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li><?php echo $bookings->faculty; ?></li>
                                                <li>level <?php echo $bookings->level; ?></li>
                                                <li><?php echo $bookings->capacity; ?> guests</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->
                    <tr>
                        <td>
                            <?php echo $bookings->booking_id; ?>
                        </td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#user<?php echo $bookings->booking_id; ?>" class="btn btn-sm btn-outline-secondary">view</button>
                        </td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#lab<?php echo $bookings->booking_id; ?>" class="btn btn-sm btn-outline-secondary">view</button>
                        </td>
                        <td><?php echo $bookings->start_date; ?></td>
                        <td><?php echo $bookings->end_date; ?></td>
                        <td><?php echo $bookings->start_time; ?></td>
                        <td><?php echo $bookings->end_time; ?></td>
                        <td><?php echo $bookings->purpose; ?></td>
                        <td><?php echo $bookings->supervisor; ?></td>
                        <td><?php echo $bookings->participants; ?></td>
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
                                <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-6 d-flex justify-content-center">
                                            <button data-bs-toggle="modal" data-bs-target="#accept<?php echo $bookings->booking_id; ?>" type="button" class="btn btn-sm btn-outline-success me-2">approve</button>
                                            <button data-bs-toggle="modal" data-bs-target="#reject<?php echo $bookings->booking_id; ?>" type="button" class="btn btn-sm btn-outline-danger">reject</button>
                                        </div>
                                    </div>
                                </div>
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