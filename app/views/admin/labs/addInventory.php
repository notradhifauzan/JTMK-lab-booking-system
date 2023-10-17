<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<?php flash('addLab_success'); ?>
<main class="bg-light rounded-2">
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-md-5 col-lg-4 order-md-last mb-3 rounded-2">
            <img class="rounded-2" width="100%" height="100%" src="<?php echo URLROOT; ?>/img/backgrounds/laptop1.jpg" alt="">
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Add new Inventory</h4>
            <form action="<?php echo URLROOT; ?>/admins/addInventory/<?php echo $data['lab']->lab_id; ?>" method="POST" class="needs-validation">
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
                        <input type="number" class="form-control" name="capacity" id="capacity" placeholder="" value="<?php echo $data['lab']->capacity ?>" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="inv_name" class="form-label">Inventory name</label>
                        <input type="test" class="form-control" name="inv_name" id="inv_name" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div id="emailHelp" class="form-text">You can always add more inventory later.</div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-sm mb-3" type="submit">Add</button>
                <button onclick="location.href='<?php echo URLROOT; ?>/admins/allLabs'" class="w-100 btn btn-outline-secondary btn-sm mb-3" type="button">I'll do this later</button>
            </form>
        </div>
    </div>
</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>