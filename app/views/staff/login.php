<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/general_navbar.php'; ?>
<?php flash('staff_register_success'); ?>
<?php flash('staff_register_fail'); ?>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start rounded" style="background-color:whitesmoke;">
            <h5 class="mt-4" style="text-align: center;">JABATAN TEKNOLOGI MAKLUMAT DAN KOMUNIKASI (JTMK) LAB BOOKING</h5>
            <img src="<?php echo URLROOT; ?>/img/logos/PKT_no_bg.png" alt="" class="" width="500px" height="px">
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form action="<?php echo URLROOT; ?>/staffs/login" class="p-4 p-md-5 border rounded-3 bg-light needs-validation" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?php if (!empty($data['staffic_err'])) echo 'is-invalid'; ?>" name="staffic" id="floatingInput" value="<?php echo $data['staffic']; ?>" placeholder="name@example.com" required>
                    <label for="floatingInput">Staff IC</label>
                    <div class="invalid-feedback">
                        <?php echo $data['staffic_err']; ?>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?php if (!empty($data['password_err'])) echo 'is-invalid'; ?>" name="password" value="<?php echo $data['password']; ?>" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    <div class="invalid-feedback">
                        <?php echo $data['password_err']; ?>
                    </div>
                </div>
                <button  class="w-100 btn btn-sm btn-primary" type="submit">Login</button>
                <hr class="my-4">
                <div class="text-center">
                    <span>Don't have an account?</span>
                    <a href="<?php echo URLROOT; ?>/staffs/registration" class="link-primary ms-1">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>