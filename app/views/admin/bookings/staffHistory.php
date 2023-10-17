<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<main class="bg-light rounded-2 p-3">
    <div class="mb-2 mt-2" style="width:40%">
        <select id="mySelect" class="form-select" onchange="goToPage()">
            <option value="">View booking history by</option>
            <option value="<?php echo URLROOT; ?>/admins/bookingHistory/students">Students</option>
            <option value="<?php echo URLROOT; ?>/admins/bookingHistory/staffs">Staffs</option>
        </select>
    </div>
    <h2>Staff Bookings history</h2>
    <div class="table-responsive">
        <table id="bookings" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Staff</th>
                    <th scope="col">Selected lab</th>
                    <th scope="col">Start date</th>
                    <th scope="col">End date</th>
                    <th scope="col">Start time</th>
                    <th scope="col">End time</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $bookings) : ?>
                    <?php
                    $bookings->start_time = date("g:i A", strtotime($bookings->start_time));
                    $bookings->end_time = date("g:i A", strtotime($bookings->end_time));
                    ?>
                    <!-- modal to view user details -->
                    <div class="modal fade" id="user<?php echo $bookings->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Staff details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="name" class="form-label">Staff name</label>
                                            <input disabled type="text" class="form-control" placeholder="" value="<?php echo $bookings->staff_name ?>">
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="nric" class="form-label">Staff ID</label>
                                            <input disabled type="text" class="form-control" placeholder="" value="<?php echo $bookings->staff_ic ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input disabled type="text" class="form-control" value="<?php echo $bookings->staff_phone; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input disabled type="email" class="form-control" placeholder="" value="<?php echo $bookings->staff_email; ?>">
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    function goToPage() {
        var url = document.getElementById("mySelect").value;
        if (url) {
            window.location.href = url;
        }
    }
    
    $(document).ready(function() {
        $('#bookings').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>