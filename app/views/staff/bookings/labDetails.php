<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/staff_navbar.php'; ?>

<main class="bg-light rounded-2">
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-md-5 col-lg-4 order-md-last mb-3 rounded-2">
            <img class="rounded-2" width="100%" height="400" src="<?php echo URLROOT; ?>/img/backgrounds/laptop1.jpg" alt="">
        </div>
        
        <div class="col-md-7 col-lg-8">
            <button onclick="location.href='<?php echo URLROOT; ?>/staffs/allLabs'" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Return</button>
            <h4 class="mb-3 mt-2">Lab details</h4>
            <input type="hidden" name="lab_id" value="<?php echo $data['lab']->lab_id; ?>">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="labcode" class="form-label">Lab code</label>
                    <input disabled type="text" class="form-control" name="labcode" id="labcode" placeholder="" value="<?php echo $data['lab']->lab_code ?>" required>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- might need update later (faculty management module) -->
                    <label for="faculty" class="form-label">Faculty</label>
                    <select disabled class="form-select" name="faculty" id="faculty" aria-label="Default select example" required>
                        <option value="">Select faculty</option>
                        <option <?php if ($data['lab']->faculty == 'FSKM') echo 'selected'; ?> value="FSKM">FSKM</option>
                        <option <?php if ($data['lab']->faculty == 'FSG') echo 'selected'; ?> value="FSG">FSG</option>
                        <option <?php if ($data['lab']->faculty == 'FPA') echo 'selected'; ?> value="FPA">FPA</option>
                    </select>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="level" class="form-label">Level</label>
                    <select disabled class="form-select" name="level" id="level" aria-label="Default select example" required>
                        <option value="">Select level</option>
                        <option <?php if ($data['lab']->level == 1) echo 'selected'; ?> value="1">1</option>
                        <option <?php if ($data['lab']->level == 2) echo 'selected'; ?> value="2">2</option>
                        <option <?php if ($data['lab']->level == 3) echo 'selected'; ?> value="3">3</option>
                        <option <?php if ($data['lab']->level == 4) echo 'selected'; ?> value="4">4</option>
                    </select>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input disabled type="number" class="form-control" name="capacity" id="capacity" placeholder="" value="<?php echo $data['lab']->capacity ?>" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h4>Inventories</h4>
            <br>
            <div class="table-responsive mt-2">
                <table id="inventories" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['inventories'] as $inv) : ?>
                            <tr>
                                <td><?php echo $inv->inventory_id ?></td>
                                <td><?php echo $inv->inventory_name ?></td>
                                <td><?php echo $inv->quantity ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr class="my-4">

            <button onclick="location.href='<?php echo URLROOT; ?>/staffs/labBooking/<?php echo $data['lab']->lab_id; ?>'" class="w-100 btn btn-primary btn-sm mb-3" type="button"><i class="fa-regular fa-pen-to-square"></i> Book this lab</button>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#inventories').DataTable();
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>