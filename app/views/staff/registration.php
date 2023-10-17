<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/general_navbar.php'; ?>
<main>
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-lg-7">
            <h4 class="ms-3 mb-3 mt-3">Staff Registration</h4>
            <form action="<?php echo URLROOT; ?>/staffs/registration" method="POST" class="ms-3 needs-validation">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Full name</label>
                        <input type="text" class="form-control <?php if(!empty($data['name_err'])) echo 'is-invalid'; ?>" name="name" placeholder="" value="<?php echo $data['name']; ?>" required>
                        <div class="invalid-feedback">
                            <?php echo $data['name_err']; ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="nric" class="form-label">NRIC</label>
                        <input type="text" class="form-control <?php if(!empty($data['nric_err'])) echo 'is-invalid'; ?>" name="nric" placeholder="" value="<?php echo $data['nric']; ?>" required>
                        <div class="invalid-feedback">
                        <?php echo $data['nric_err']; ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control <?php if(!empty($data['phone_err'])) echo 'is-invalid'; ?>" id="phone" value="<?php echo $data['phone']; ?>" name="phone" required>
                        <div class="invalid-feedback">
                        <?php echo $data['phone_err']; ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?php if(!empty($data['email_err'])) echo 'is-invalid'; ?>" name="email" placeholder="" value="<?php echo $data['email']; ?>" required>
                        <div class="invalid-feedback">
                        <?php echo $data['email_err']; ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?php if(!empty($data['password_err'])) echo 'is-invalid'; ?>" name="password" placeholder="" value="<?php echo $data['password']; ?>" required>
                        <div class="invalid-feedback">
                        <?php echo $data['password_err']; ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control <?php if(!empty($data['confirm_password_err'])) echo 'is-invalid'; ?>" name="confirm_password" placeholder="" value="<?php echo $data['confirm_password']; ?>" required>
                        <div class="invalid-feedback">
                        <?php echo $data['confirm_password_err']; ?>
                        </div>
                    </div>

                    <hr class="">
                    <button class="w-100 btn btn-success btn-sm mb-3" type="submit">Register</button>
            </form>
        </div>
    </div>
</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>