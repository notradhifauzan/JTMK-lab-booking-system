<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/general_navbar.php'; ?>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start rounded" style="background-color:whitesmoke;">
            <h5 class="mt-4" style="text-align: center;">JABATAN TEKNOLOGI MAKLUMAT DAN KOMUNIKASI (JTMK) LAB BOOKING</h5>
            <img src="<?php echo URLROOT; ?>/img/logos/PKT_no_bg.png" alt="" class="" width="500px" height="px">
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form action="<?php echo URLROOT; ?>/admins/login" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                <div class="form-floating mb-3">
                    <input required name="username" type="text" class="form-control <?php if(!empty($data['username_err'])) echo 'is-invalid'; ?>" id="floatingInput" value="<?php echo $data['username']; ?>" placeholder="name@example.com">
                    <label for="floatingInput">Admin Username</label>
                    <div class="invalid-feedback">
                    <?php echo $data['username_err']; ?>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input required name="password" type="password" class="form-control <?php if(!empty($data['password_err'])) echo 'is-invalid'; ?>" id="floatingPassword" value="<?php echo $data['password']; ?>" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    <div class="invalid-feedback">
                    <?php echo $data['password_err']; ?>
                    </div>
                </div>
                <button class="w-100 btn btn-sm btn-primary" type="submit">Login</button>
                <hr class="my-4">
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>