<header class="p-3 mb-3 border-bottom bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-light">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="<?php echo URLROOT; ?>/img/logos/PKT_no_bg.png" alt="" width="82px">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Users
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/allStaffs">Staffs</a></li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/allStudents">Students</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Labs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/allLabs">View all</a></li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/addLab">Add new lab</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bookings
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/staffBookings">Staff bookings</a></li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/studentBookings">Student bookings</a></li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/bookingHistory/students">History</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo URLROOT; ?>/img/logos/admin_icon.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo URLROOT; ?>">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container main-container">
    <!-- the ending div should be in the footer.php -->