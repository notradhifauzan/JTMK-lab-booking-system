<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/admin_navbar.php'; ?>
<main class="bg-light rounded-2">
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-md-5 col-lg-4 order-md-last mb-3 rounded-2">
            <img class="rounded-2" width="100%" height="100%" src="<?php echo URLROOT; ?>/img/backgrounds/laptop1.jpg" alt="">
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">New lab registration</h4>
            <form action="<?php echo URLROOT; ?>/admins/addLab" method="POST" class="needs-validation">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="labcode" class="form-label">Lab code</label>
                        <input type="text" class="form-control" name="labcode" id="labcode" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- might need update later (faculty management module) -->
                        <label for="faculty" class="form-label">Faculty</label>
                        <select class="form-select" name="faculty" id="faculty" aria-label="Default select example" required>
                            <option selected value="">Select faculty</option>
                            <option value="FSKM">FSKM</option>
                            <option value="FSG">FSG</option>
                            <option value="FPA">FPA</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" name="level" id="level" aria-label="Default select example" required>
                            <option selected value="">Select level</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control" name="capacity" id="capacity" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-sm mb-3" type="submit">Add</button>
            </form>
        </div>
    </div>
</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>