    <header class="p-3 mb-3 border-bottom bg-light">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-light">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="<?php echo URLROOT; ?>/img/logos/PKT_no_bg.png" alt="" width="82px">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Labs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/students/myBookings">My bookings</a></li>
                            <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/students/allLabs">View all labs</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="nav-link px-2 link-dark">Navigation 3</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Navigation 4</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="hidden" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo URLROOT; ?>/img/logos/stud_icon.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/students/logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <!-- the ending div should be in the footer.php -->