<?php
class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
    }

    public function bookingHistory($user)
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('admins/login');
        } else {
            if ($user == 'students') {
                $data = [
                    'bookings' => $this->adminModel->bookingHistory($user),
                ];

                $this->view('admin/bookings/studentHistory', $data);
            } else if ($user == 'staffs') {
                $data = [
                    'bookings' => $this->adminModel->bookingHistory($user),
                ];

                $this->view('admin/bookings/staffHistory', $data);
            }
        }
    }

    public function approveBooking($booking_id)
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('admins/login');
        } else {
            $booking = $this->adminModel->getBookingDetails($booking_id);

            $data = [
                'lab_id' => $booking->lab_id,
                'startDate' => $booking->start_date,
                'endDate' => $booking->end_date,
                'startTime' => $booking->start_time,
                'endTime' => $booking->end_time,
            ];

            if ($this->adminModel->labBookingAvailable($data)) {
                if ($this->adminModel->approveBooking($booking_id,$_SESSION['currentUser']->adminid)) {
                    flash('booking_approve_success', 'Successfully approved booking.');
                    if ($booking->stud_matric == null) {
                        //redirect to staff booking
                        redirect('admins/staffBookings');
                    } else {
                        //redirect to student booking
                        redirect('admins/studentBookings');
                    }
                } else {
                    flash('booking_approve_fail', 'Failed to approve booking. Something went wrong', 'alert alert-danger');
                    if ($booking->stud_matric == null) {
                        //redirect to staff booking
                        redirect('admins/staffBookings');
                    } else {
                        //redirect to student booking
                        redirect('admins/studentBookings');
                    }
                }
            } else {
                flash('booking_approve_fail', 'Failed to approve booking due to overlapped time-slot/date', 'alert alert-danger');
                if ($booking->stud_matric == null) {
                    //redirect to staff booking
                    redirect('admins/staffBookings');
                } else {
                    //redirect to student booking
                    redirect('admins/studentBookings');
                }
            }
        }
    }

    public function rejectBooking($booking_id)
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('admins/login');
        } else {
            $booking = $this->adminModel->getBookingDetails($booking_id);
            if ($this->adminModel->rejectBooking($booking_id,$_SESSION['currentUser']->adminid)) {
                flash('booking_reject_success', 'Booking successfully rejected');
                if ($booking->stud_matric == null) {
                    //redirect to staff booking
                    redirect('admins/staffBookings');
                } else {
                    //redirect to student booking
                    redirect('admins/studentBookings');
                }
            } else {
                flash('booking_reject_fail', 'Failed to reject booking. Something went wrong.', 'alert alert-danger');
                if ($booking->stud_matric == null) {
                    //redirect to staff booking
                    redirect('admins/staffBookings');
                } else {
                    //redirect to student booking
                    redirect('admins/studentBookings');
                }
            }
        }
    }

    public function staffBookings()
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('admins/login');
        } else {
            $data = [
                'bookings' => $this->adminModel->getStaffBookings(),
            ];

            $this->view('admin/bookings/staffBookings', $data);
        }
    }

    public function studentBookings()
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('admins/login');
        } else {
            $data = [
                'bookings' => $this->adminModel->getStudentBookings(),
            ];

            $this->view('admin/bookings/studentBookings', $data);
        }
    }

    public function allStudents()
    {
        $data = [
            'users' => $this->adminModel->getAllStudents(),
        ];

        $this->view('admin/users/allStudents', $data);
    }

    public function addInventory($lab_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'inv_name' => trim($_POST['inv_name']),
                'quantity' => trim($_POST['quantity']),
                'lab_id' => $_POST['lab_id'],
                'admin_id' => $_SESSION['currentUser']->adminid,
            ];

            if ($this->adminModel->addInventory($data)) {
                flash('add_inv_success', 'Successfully added new inventory');
                redirect('admins/viewLabDetails/' . $data['lab_id']);
            } else {
                flash('add_inv_fail', 'Failed to add new inventory. Something went wrong.', 'alert alert-danger');
                redirect('admins/viewLabDetails' . $data['lab_id']);
            }
        } else {
            $data = [
                'lab' => $this->adminModel->getLabDetails($lab_id),
            ];

            $this->view('admin/labs/addInventory', $data);
        }
    }

    public function deleteLab($lab_id)
    {
        if ($this->adminModel->deleteLab($lab_id)) {
            flash('lab_delete_success', 'Successfully deleted lab');
            redirect('admins/allLabs');
        } else {
            flash('lab_delete_fail', 'Failed to delete lab. Something went wrong', 'alert alert-danger');
            redirect('admins/allLabs');
        }
    }

    public function deleteInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->adminModel->deleteInventory($_POST['inv_id'])) {
                flash('delete_inv_success', 'Successfully deleted inventory');
                redirect('admins/viewLabDetails/' . $_POST['lab_id']);
            } else {
                flash('delete_inv_fail', 'Failed to delete inventory. Something went wrong', 'alert alert-danger');
                redirect('admins/viewLabDetails/' . $_POST['lab_id']);
            }
        }
    }

    public function updateInventory($inv_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'inv_name' => trim($_POST['inv_name']),
                'quantity' => trim($_POST['quantity']),
                'inv_id' => $inv_id,
                'lab_id' => $_POST['lab_id'],
            ];

            if ($this->adminModel->updateInventory($data)) {
                flash('update_inv_success', 'Successfully updated inventory');
                redirect('admins/viewLabDetails/' . $data['lab_id']);
            } else {
                flash('update_inv_fail', 'Failed to update inventory. Something went wrong', 'alert alert-danger');
                redirect('admins/viewLabDetails/' . $data['lab_id']);
            }
        }
    }

    public function viewLabDetails($lab_id)
    {
        $data = [
            'lab' => $this->adminModel->getLabDetails($lab_id),
            'inventories' => $this->adminModel->getInventories($lab_id),
        ];

        $this->view('admin/labs/labDetails', $data);
    }

    public function updateLab($labid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'labcode' => trim($_POST['labcode']),
                'faculty' => trim($_POST['faculty']),
                'level' => trim($_POST['level']),
                'capacity' => trim($_POST['capacity']),
                'lab_id' => $labid,
            ];

            $data['labcode'] = strtoupper($data['labcode']);
            $data['faculty'] = strtoupper($data['faculty']);

            if ($this->adminModel->updateLab($data)) {
                flash('updateLab_success', 'Successfully updated lab details');
                redirect('admins/viewLabDetails/' . $data['lab_id']);
            } else {
                flash('updateLab_fail', 'Failed to update lab details. Something went wrong', 'alert alert-danger');
                redirect('admins/viewLabDetails/' . $data['lab_id']);
            }
        }
    }

    public function addLab()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'labcode' => trim($_POST['labcode']),
                'faculty' => trim($_POST['faculty']),
                'level' => trim($_POST['level']),
                'capacity' => trim($_POST['capacity']),
                'lab_id' => '',
                'admin_id' => $_SESSION['currentUser']->adminid,

                'labcode_err' => '',
                'faculty_err' => '',
                'level_err' => '',
                'capacity_err' => '',
            ];

            $data['labcode'] = strtoupper($data['labcode']);
            $data['faculty'] = strtoupper($data['faculty']);

            if (
                empty($data['labcode_err']) && empty($data['faculty_err']) &&
                empty($data['level_err']) && empty($data['capacity_err'])
            ) {
                $lab_id = $this->adminModel->addLab($data);
                if ($lab_id > 0) {
                    flash('addLab_success', 'New lab successfully registered. Please register at least one lab inventory');
                    $url = 'admins/addInventory/' . $lab_id;
                    redirect($url);
                } else {
                    flash('addLab_fail', 'Failed to register new lab. Something went wrong');
                    die('something went wrong');
                }
            }
        } else {
            $data = [
                'labcode' => '',
                'faculty' => '',
                'level' => '',
                'capacity' => '',
                'lab_id' => '',

                'labcode_err' => '',
                'faculty_err' => '',
                'level_err' => '',
                'capacity_err' => '',
            ];
            $this->view('admin/labs/addLab', $data);
        }
    }

    public function allLabs()
    {
        $data = [
            'labs' => $this->adminModel->getAllLabs(),
        ];

        $this->view('admin/labs/allLabs', $data);
    }

    public function allStaffs()
    {
        $data = [
            'users' => $this->adminModel->getAllStaffs(),
        ];

        $this->view('admin/users/allStaffs', $data);
    }

    public function deleteStudents($id)
    {
        if ($this->adminModel->deleteStudent($id)) {
            flash('stud_delete_success', 'Successfully deleted student');
            redirect('admins/allStudents');
        } else {
            flash('stud_delete_fail', 'Failed to delete student. Something went wrong', 'alert alert-danger');
            redirect('admins/allStudents');
        }
    }

    public function deleteStaffs($id)
    {
        if ($this->adminModel->deleteStaff($id)) {
            flash('staff_delete_success', 'Successfully deleted staff');
            redirect('admins/allStaffs');
        } else {
            flash('staff_delete_fail', 'Failed to delete staff. Something went wrong', 'alert alert-danger');
            redirect('admins/allStaffs');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),

                'username_err' => '',
                'password_err' => '',
            ];

            if (!$this->adminModel->usernameExist($data['username'])) {
                $data['username_err'] = 'admin username does not exist';
            }

            if (empty($data['username_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->adminModel->login($data['username'], $data['password']);
                $_SESSION['currentUser'] = $loggedInUser;
                if ($loggedInUser) {
                    redirect('admins/allStudents');
                } else {
                    $data['password_err'] = 'wrong password';
                    $this->view('admin/login', $data);
                }
            } else {
                //load view with errors
                $this->view('admin/login', $data);
            }
        } else {
            //init data
            $data = [
                'username' => '',
                'password' => '',

                'username_err' => '',
                'password_err' => '',
            ];

            $this->view('admin/login', $data);
        }
    }
}
