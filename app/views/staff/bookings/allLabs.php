<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/staff_navbar.php'; ?>
<main>

    <section class="py-5 text-center container bg-light rounded-1">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">JTMK COMPUTER LABS</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($data['labs'] as $labs) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" src="<?php echo URLROOT; ?>/img/backgrounds/computer_lab1.jpg" width="100%" height="225" alt="">
                            <div class="card-body text-center">
                                <h1 class="card-title pricing-card-title"><?php echo $labs->lab_code; ?></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><?php echo $labs->faculty; ?></li>
                                    <li>level <?php echo $labs->level; ?></li>
                                    <li><?php echo $labs->capacity; ?> guests</li>
                                </ul>
                                <center>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button onclick="location.href='<?php echo URLROOT; ?>/staffs/viewLabDetails/<?php echo $labs->lab_id; ?>'" type="button" class="btn btn-sm btn-outline-secondary">View facilities</button>
                                            <button onclick="location.href='<?php echo URLROOT; ?>/staffs/labBooking/<?php echo $labs->lab_id; ?>'" type="button" class="btn btn-sm btn-outline-secondary">Book this lab</button>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>