<?php
class Staffs extends Controller
{
    public function __construct()
    {
        $this->staffModel = $this->model('Staff');
    }

    public function validateTime($start_time, $end_time)
    {
        // Convert start and end times to 24-hour format for easy comparison
        $start_time_24h = date('H:i', strtotime($start_time));
        $end_time_24h = date('H:i', strtotime($end_time));

        // Check if start and end times are in correct format
        if (!$start_time_24h || !$end_time_24h) {
            return false;
            //die('invalid time format');
        }

        // Check if start time is before end time
        if ($start_time_24h >= $end_time_24h) {
            return false;
            //die('startTime is greater than endTime');
        }

        // Check if start and end times are in AM or PM
        /*
        $start_am_pm = date('a', strtotime($start_time));
        $end_am_pm = date('a', strtotime($end_time));
        if ($start_am_pm !== $end_am_pm) {
            return false;
            //die('what is this?');
        }
        */

        // All checks passed, times are valid
        return true;
        //die('valid time');
    }

    public function myBookings()
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('staffs/login');
        } else {
            $data = [
                'bookings' => $this->staffModel->myBookings($_SESSION['currentUser']->staff_ic),
            ];

            $this->view('staff/bookings/myBookings', $data);
        }
    }

    public function cancelBooking($booking_id)
    {
        if(!isset($_SESSION['currentUser']))
        {
            redirect('staffs/login');
        } else {
            if($this->staffModel->cancelBooking($booking_id))
            {
                flash('booking_cancel_success','Successfully cancelled booking.');
                redirect('staffs/myBookings');
            } else {
                flash('booking_cancel_fail','Failed to cancel booking. Something went wrong.','alert alert-danger');
                redirect('staffs/myBookings');
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['currentUser']);
        redirect('staffs/login');
    }

    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'nric' => trim($_POST['nric']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),

                'name_err' => '',
                'nric_err' => '',
                'phone_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //ic validation
            if (empty($data['nric'])) {
                $data['nric_err'] = 'Please insert your NRIC number';
            } else {
                if (strlen($data['nric']) != 12) {
                    $data['nric_err'] = 'Invalid NRIC length';
                }
                if (!is_numeric($data['nric'])) {
                    $data['nric_err'] = 'Invalid NRIC';
                }
                //check duplicate IC
                if ($this->staffModel->findStaffByIC($data['nric'])) {
                    $data['nric_err'] = 'NRIC is already taken';
                }
            }

            //phone validation
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Please insert your phone number';
            } else {
                if (strlen($data['phone']) > 11 || strlen($data['phone']) < 10) {
                    $data['phone_err'] = 'Invalid phone number length';
                }
                if (!is_numeric($data['phone'])) {
                    $data['phone_err'] = 'Invalid phone number';
                }
                //check duplicate phone number
                if ($this->staffModel->findStaffByPhone($data['phone'])) {
                    $data['phone_err'] = 'Phone number is already taken';
                }
            }

            //email validation
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter your email";
            } else {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = "Invalid email format";
                }

                if ($this->staffModel->findStaffByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            //password validation
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            } else {
                if (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password should be at least 6 characters';
                } else {
                    $uppercase = preg_match('@[A-Z]@', $data['password']);
                    $lowercase = preg_match('@[a-z]@', $data['password']);
                    $number    = preg_match('@[0-9]@', $data['password']);
                    $specialChars = preg_match('@[^\w]@', $data['password']);

                    if (!$uppercase) {
                        $data['password_err'] = 'Password should contain at least one uppercase letter';
                    } else if (!$lowercase) {
                        $data['password_err'] = 'Password should contain at least one lowercase letter';
                    } else if (!$number) {
                        $data['password_err'] = 'Password should contain at least one number';
                    } else if (!$specialChars) {
                        $data['password_err'] = 'Password should contain at least one special character';
                    }
                }
            }

            //confirm password validation
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Password did not match';
                }
            }

            //validate errors
            if (
                empty($data['name_err']) && empty($data['nric_err']) && empty($data['phone_err']) &&
                empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])
            ) {
                $data['name'] = strtoupper($data['name']);
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->staffModel->register($data)) {
                    $message = 'Successfully registered, please log in using your NRIC number';
                    flash('staff_register_success', $message);
                    redirect('staffs/login');
                } else {
                    $message = 'Registration failed. Please contact admin for enquiries';
                    flash('staff_register_fail', $message, 'alert alert-danger');
                    $this->view('staff/registration', $data);
                }
            } else {
                //load views with errors
                $this->view('staff/registration', $data);
            }
        } else {
            //init data
            $data = [
                'name' => '',
                'nric' => '',
                'phone' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',

                'name_err' => '',
                'nric_err' => '',
                'phone_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            $this->view('staff/registration', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'staffic' => trim($_POST['staffic']),
                'password' => $_POST['password'],

                'staffic_err' => '',
                'password_err' => '',
            ];

            //validate ic
            if (empty($data['staffic'])) {
                $data['staffic_err'] = 'Please enter your IC';
            } else {
                if (!$this->staffModel->findStaffByIc($data['staffic'])) {
                    $data['staffic_err'] = 'User does not exist';
                }
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            }

            if (empty($data['staffic_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->staffModel->login($data['staffic'], $data['password']);
                $_SESSION['currentUser'] = $loggedInUser;
                if ($loggedInUser) {
                    redirect('staffs/allLabs');
                } else {
                    $data['password_err'] = 'wrong password';
                    $this->view('staff/login', $data);
                }
            } else {
                //load view with errors
                $this->view('staff/login', $data);
            }
        } else {
            //init data
            $data = [
                'staffic' => '',
                'password' => '',

                'staffic_err' => '',
                'password_err' => '',
            ];

            $this->view('staff/login', $data);
        }
    }

    public function allLabs()
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('staffs/login');
        } else {
            $data = [
                'labs' => $this->staffModel->getAllLabs(),
            ];

            $this->view('staff/bookings/allLabs', $data);
        }
    }

    public function labBooking($lab_id)
    {
        if (!isset($_SESSION['currentUser'])) {
            redirect('staffs/login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'lab' => $this->staffModel->getLabDetails($lab_id),
                    'inventories' => $this->staffModel->getInventories($lab_id),
                    'staff' => $_SESSION['currentUser'],
                    'staff_ic' => $_SESSION['currentUser']->staff_ic,

                    'startDate' => $_POST['startDate'],
                    'endDate' => $_POST['endDate'],
                    'hour_start' => $_POST['hour_start'],
                    'minute_start' => $_POST['minute_start'],
                    'hour_end' => $_POST['hour_end'],
                    'minute_end' => $_POST['minute_end'],
                    'pm_am_start' => $_POST['pm_am_start'],
                    'pm_am_end' => $_POST['pm_am_end'],

                    'startTime' => '',
                    'endTime' => '',

                    'purpose' => trim($_POST['purpose']),
                    'participants' => $_POST['participants'],

                    'startTime_err' => '',
                    'endTime_err' => '',
                    'timeslot_err' => '',
                    'bookingDate_err' => '',
                ];

                $data['startTime'] = $data['hour_start'] . ':' . $data['minute_start'] . ' ' . $data['pm_am_start'];
                $data['endTime'] = $data['hour_end'] . ':' . $data['minute_end'] . ' ' . $data['pm_am_end'];

                if (!$this->validateTime($data['startTime'], $data['endTime'])) {
                    $data['timeslot_err'] = 'Invalid time-slot range';
                    flash('timeslot_err', 'Invalid timeslot. Please select a valid time-slot range.', 'alert alert-warning');
                } else {
                    $data['startTime'] = date('H:i', strtotime($data['startTime']));
                    $data['endTime'] = date('H:i', strtotime($data['endTime']));

                    $data['startTime'] = $data['startTime'] . ':00';
                    $data['endTime'] = $data['endTime'] . ':00';
                }

                //date validation
                if (date($data['endDate']) < date($data['startDate'])) {
                    $data['date_err'] = 'Invalid date';
                }

                if (empty($data['timeslot_err']) && empty($data['date_err'])) {

                    if ($this->staffModel->labBookingAvailable($data)) {
                        if ($this->staffModel->labBooking($data)) {
                            flash('booking_success', 'Successfully placed booking. Kindly wait for approval');
                            redirect('staffs/myBookings');
                        } else {
                            flash('booking_fail', 'Failed to place booking. Something went wrong', 'alert alert-danger');
                            //load view with error
                            $this->view('staff/bookings/labBooking', $data);
                        }
                    } else {
                        flash('booking_full', 'Lab is full. Please select another date/timeslot', 'alert alert-danger');
                        //load view with error
                        $this->view('staff/bookings/labBooking', $data);
                    }
                } else {
                    //load view with error
                    $this->view('staff/bookings/labBooking', $data);
                }
            } else {
                $data = [
                    'lab' => $this->staffModel->getLabDetails($lab_id),
                    'inventories' => $this->staffModel->getInventories($lab_id),
                    'staff' => $_SESSION['currentUser'],

                    'startTime_err' => '',
                    'startDate' => '',
                    'endDate' => '',
                    'endTime_err' => '',
                    'startTime' => '',
                    'endTime' => '',

                    'purpose' => '',
                    'participants' => '',

                    'startTime_err' => '',
                    'endTime_err' => '',
                    'timeslot_err' => '',
                    'startDate_err' => '',
                    'endDate_err' => '',
                ];
                $this->view('staff/bookings/labBooking', $data);
            }
        }
    }

    public function viewLabDetails($lab_id)
    {
        $data = [
            'lab' => $this->staffModel->getLabDetails($lab_id),
            'inventories' => $this->staffModel->getInventories($lab_id),
        ];

        $this->view('staff/bookings/labDetails', $data);
    }
}
