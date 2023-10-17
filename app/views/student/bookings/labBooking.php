<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/student_navbar.php'; ?>
<div class="position-relative overflow-hidden p-3 p-md-1 m-md-4 text-center bg-light rounded-1 bg-computer">
    <div class="col-md-5 p-lg-5 mx-auto my-5 border">
        <h2 class="fw-normal text-header">JTMK COMPUTER LAB</h2>
    </div>
</div>
<hr>
<div class="container rounded" style="background-color: aliceblue;">
    <main class="p-2">
        <!-- Modal -->
        <div class="modal fade" id="timetable" tabindex="-1" aria-labelledby="timetable" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="timetable">JTMK TIMETABLE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe src="<?php echo URLROOT; ?>/pdfs/timetable.pdf" height="500" width="750"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php flash('timeslot_err'); ?>
        <?php flash('booking_full'); ?>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="<?php echo URLROOT; ?>/img/logos/PKT_no_bg.png" alt="" width="120" height="57">
            <h2>Lab Booking Form <small class="text-muted"></small></h2>
        </div>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Facilities at <?php echo $data['lab']->lab_code; ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach($data['inventories'] as $inventories): ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo $inventories->inventory_name; ?></h6>
                            <small class="text-muted"><?php echo $inventories->quantity; ?> unit</small>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary">View class and faculty timetable</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#timetable" class="btn btn-sm btn-outline-success">view schedule</button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <form action="<?php echo URLROOT; ?>/students/labBooking/<?php echo $data['lab']->lab_id; ?>" class="needs-validation" method="POST">
                    <input type="hidden" name="stud_id" value="<?php echo $data['student']->stud_id; ?>">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Name</label>
                            <input disabled type="text" class="form-control" name="name" placeholder="" value="<?php echo $data['student']->stud_name; ?>" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="id" class="form-label">Matric ID</label>
                            <input disabled type="text" class="form-control" name="matric" placeholder="" value="<?php echo $data['student']->matric_id; ?>" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="semester" class="form-label">Semester</label>
                            <select disabled class="form-control mb-3" id="semester" aria-label="Default select example">
                                <option class="rounded-1" value="0">Select one</option>
                                <option <?php if ($data['student']->stud_semester == 1) echo 'selected'; ?> value="1">Semester 1</option>
                                <option <?php if ($data['student']->stud_semester == 2) echo 'selected'; ?> value="2">Semester 2</option>
                                <option <?php if ($data['student']->stud_semester == 3) echo 'selected'; ?> value="3">Semester 3</option>
                                <option <?php if ($data['student']->stud_semester == 4) echo 'selected'; ?> value="4">Semester 4</option>
                                <option <?php if ($data['student']->stud_semester == 5) echo 'selected'; ?> value="5">Semester 5</option>
                                <option <?php if ($data['student']->stud_semester == 6) echo 'selected'; ?> value="6">Semester 6</option>
                                <option <?php if ($data['student']->stud_semester == 7) echo 'selected'; ?> value="7">Semester 7</option>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="class" class="form-label">Class</label>
                            <input disabled type="text" class="form-control" name="class" value="<?php echo $data['student']->stud_class ?>" placeholder="">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="purpose" class="form-label">Purpose/Subject</label>
                            <input type="text" class="form-control" name="purpose" value="<?php echo $data['purpose']; ?>" placeholder="" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="lecturer" class="form-label">Lecturer/Supervisor</label>
                            <input type="text" class="form-control" name="supervisor" placeholder="" value="<?php echo $data['supervisor']; ?>" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="participants" class="form-label">Number of Participants</label>
                            <input type="number" class="form-control" name="participants" id="participants" value="<?php echo $data['participants']; ?>" placeholder="" required>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="startDate" class="form-label">Start Date of Booking</label>
                            <input type="date" class="form-control <?php if (!empty($data['date_err'])) echo 'is-invalid'; ?>" name="startDate" placeholder="" value="<?php echo $data['startDate']; ?>" required>
                            <div class="invalid-feedback">
                                <?php echo $data['date_err']; ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="endDate" class="form-label">End Date of Booking</label>
                            <input type="date" class="form-control <?php if (!empty($data['date_err'])) echo 'is-invalid'; ?>" name="endDate" placeholder="" value="<?php echo $data['endDate']; ?>" required>
                            <div class="invalid-feedback">
                                <?php echo $data['date_err']; ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="startTime" class="form-label">Start Time</label>
                            <select class="mb-3" name="hour_start" aria-label="Default select example" required>
                                <option class="rounded-1" value="8" selected>8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="9">9</option>
                            </select> :
                            <select class="mb-3" name="minute_start" aria-label="Default select example" required>
                                <option class="rounded-1" value="00" selected>00</option>
                                <option value="30">30</option>
                            </select> :
                            <select class="mb-3" name="pm_am_start" aria-label="Default select example" required>
                                <option class="rounded-1 <?php if(!empty($data['timeslot_err'])) echo 'is-invalid'; ?>" value="AM" selected>AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo $data['timeslot_err']; ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="startDate" class="form-label">End Time&nbsp;</label>
                            <select class="mb-3 is-invalid" name="hour_end" aria-label="Default select example" required>
                                <option class="rounded-1" value="9" selected>9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select> :
                            <select class="mb-3" name="minute_end" aria-label="Default select example" required>
                                <option class="rounded-1" value="00" selected>00</option>
                                <option value="30">30</option>
                            </select> :
                            <select class="mb-3" name="pm_am_end" aria-label="Default select example" required>
                                <option class="rounded-1 <?php if(!empty($data['timeslot_err'])) echo 'is-invalid'; ?>" value="AM" selected>AM</option>
                                <option value="PM">PM</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo $data['timeslot_err']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="lab" class="form-label">Lab</label>
                        <input disabled type="text" class="form-control" value="<?php echo $data['lab']->lab_code; ?>">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-sm mb-3" type="submit">Submit booking</button>
                </form>
            </div>
        </div>
    </main>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>