<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/general_navbar.php'; ?>
<main>
    <div class="mt-4 row g-4 bg-light rounded col-12 col-lg-8 mx-auto">
        <div class="col-lg-7">
            <h4 class="ms-3 mb-3 mt-3">Student Registration</h4>
            <form action="<?php echo URLROOT; ?>/students/registration" method="POST" class="ms-3 needs-validation">
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

                    <div class="col-sm-6">
                        <label for="year_enroll" class="form-label">Year Enroll</label>
                        <select class="form-select" name="year_enroll" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['year_enroll'] == '19') echo 'selected'; ?> value="19">2019</option>
                            <option <?php if($data['year_enroll'] == '20') echo 'selected'; ?> value="20">2020</option>
                            <option <?php if($data['year_enroll'] == '21') echo 'selected'; ?> value="21">2021</option>
                            <option <?php if($data['year_enroll'] == '22') echo 'selected'; ?> value="22">2022</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="session_enroll" class="form-label">Sesssion Enroll</label>
                        <select class="form-select" name="session_enroll" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['session_enroll'] == '1') echo 'selected'; ?> value="1">July</option>
                            <option <?php if($data['session_enroll'] == '2') echo 'selected'; ?> value="2">December</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="study_mode" class="form-label">Study Mode</label>
                        <select class="form-select" name="study_mode" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['study_mode'] == 'F') echo 'selected'; ?> value="F">Full Time</option>
                            <option <?php if($data['study_mode'] == 'P') echo 'selected'; ?> value="P">Part Time</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" name="semester" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['semester'] == '1') echo 'selected'; ?> value="1">1</option>
                            <option <?php if($data['semester'] == '2') echo 'selected'; ?> value="2">2</option>
                            <option <?php if($data['semester'] == '3') echo 'selected'; ?> value="3">3</option>
                            <option <?php if($data['semester'] == '4') echo 'selected'; ?> value="4">4</option>
                            <option <?php if($data['semester'] == '5') echo 'selected'; ?> value="5">5</option>
                            <option <?php if($data['semester'] == '6') echo 'selected'; ?> value="6">6</option>
                            <option <?php if($data['semester'] == '7') echo 'selected'; ?> value="7">7</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="class" class="form-label">Class</label>
                        <select class="form-select" name="class" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['class'] == 'A') echo 'selected'; ?> value="A">A</option>
                            <option <?php if($data['class'] == 'B') echo 'selected'; ?> value="B">B</option>
                            <option <?php if($data['class'] == 'C') echo 'selected'; ?> value="C">C</option>
                            <option <?php if($data['class'] == 'D') echo 'selected'; ?> value="D">D</option>
                            <option <?php if($data['class'] == 'E') echo 'selected'; ?> value="E">E</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="course" class="form-label">Course</label>
                        <select class="form-select" name="course" aria-label="Default select example" required>
                            <option value="">Select one</option>
                            <option <?php if($data['course'] == 'DDT') echo 'selected'; ?> value="DDT">Diploma Digital Teknologi Maklumat (Teknologi Digital)</option>
                            <option <?php if($data['course'] == 'DEE') echo 'selected'; ?> value="DEE">Diploma Kejuruteraan Elektrik dan Elektronik</option>
                            <option <?php if($data['course'] == 'DEP') echo 'selected'; ?> value="DEP">Diploma Kejuruteraan Elektronik (Komunikasi)</option>
                        </select>
                        <div class="invalid-feedback">
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