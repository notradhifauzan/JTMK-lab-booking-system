<?php
class Admin
{
    public function __construct()
    {
        $this->db = new Database();
    }

    //Login Admin
    public function login($username, $password)
    {
        //finding the user with that username
        $this->db->query('SELECT * FROM admins WHERE admin_username=:username;');
        $this->db->bind(':username', $username);
        //single method will return the whole row as object
        //so you can treat $row as an object, and access the password

        $row = $this->db->single();

        if ($password == $row->admin_password) {
            return $row;
        } else {
            return false;
        }
    }

    public function approveBooking($booking_id, $admin_id)
    {
        $this->db->query('update lab_bookings set status=:status,admin_id=:admin_id where booking_id=:booking_id');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':status', 'booked');
        $this->db->bind(':admin_id', $admin_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function rejectBooking($booking_id, $admin_id)
    {
        $this->db->query('update lab_bookings set status=:status,admin_id=:admin_id where booking_id=:booking_id');
        $this->db->bind(':status', 'rejected');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':admin_id', $admin_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getBookingDetails($booking_id)
    {
        $this->db->query('select * from lab_bookings where booking_id = :booking_id;');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->execute();

        return $this->db->single();
    }

    public function getStaffBookings()
    {
        $this->db->query('select *,staffs.staff_name,staffs.staff_phone,staffs.staff_email,
                            labs.lab_id,labs.lab_code,labs.capacity,labs.level,labs.faculty
                            from lab_bookings
                            left join staffs on staffs.staff_ic = lab_bookings.lect_id
                            left join labs on labs.lab_id = lab_bookings.lab_id
                            where lab_bookings.stud_matric is null
                            and lab_bookings.status not in (:a,:b);');

        $this->db->bind(':a', 'cancelled');
        $this->db->bind(':b', 'rejected');

        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getStudentBookings()
    {
        $this->db->query('select *,students.stud_name,students.stud_phone,students.stud_phone,students.stud_semester,
                            students.stud_course,students.stud_class,students.stud_email,students.year_enroll,
                            students.study_mode,students.session_enroll,
                            labs.lab_id,labs.lab_code,labs.capacity,labs.level,labs.faculty
                            from lab_bookings
                            left join students on students.matric_id = lab_bookings.stud_matric
                            left join labs on labs.lab_id = lab_bookings.lab_id
                            where lab_bookings.lect_id is null
                            and lab_bookings.status not in (:a,:b);');

        $this->db->bind(':a', 'cancelled');
        $this->db->bind(':b', 'rejected');

        $this->db->execute();

        return $this->db->resultSet();
    }

    public function usernameExist($username)
    {
        $this->db->query('select * from admins where admin_username=:username;');
        $this->db->bind(':username', $username);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addLab($data)
    {
        $this->db->query('insert into labs (lab_code,capacity,level,faculty,admin_id)
                          values (:lab_code,:capacity,:level,:faculty,:admin_id);');
        $this->db->bind(':lab_code', $data['labcode']);
        $this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':faculty', $data['faculty']);
        $this->db->bind(':admin_id', $data['admin_id']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return 0;
        }
    }

    public function updateLab($data)
    {
        $this->db->query('update labs set lab_code=:lab_code, capacity=:capacity, level=:level,
                            faculty=:faculty where lab_id=:lab_id;');

        $this->db->bind(':lab_code', $data['labcode']);
        $this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':faculty', $data['faculty']);
        $this->db->bind(':lab_id', $data['lab_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function bookingHistory($user)
    {
        if ($user == 'students') {
            $this->db->query('select *,students.stud_name,students.stud_phone,students.stud_phone,students.stud_semester,
                            students.stud_course,students.stud_class,students.stud_email,students.year_enroll,
                            students.study_mode,students.session_enroll,
                            labs.lab_id,labs.lab_code,labs.capacity,labs.level,labs.faculty
                            from lab_bookings
                            left join students on students.matric_id = lab_bookings.stud_matric
                            left join labs on labs.lab_id = lab_bookings.lab_id
                            where lab_bookings.lect_id is null
                            and lab_bookings.status not in (:b)
                            and lab_bookings.end_date <= :end_date');

            $this->db->bind(':b', 'pending');
            $this->db->bind(':end_date', date('Y-m-d'));

            $this->db->execute();

            return $this->db->resultSet();
        } else if ($user == 'staffs') {
            $this->db->query('select *,staffs.staff_name,staffs.staff_phone,staffs.staff_email,
                                labs.lab_id,labs.lab_code,labs.capacity,labs.level,labs.faculty
                                from lab_bookings
                                left join staffs on staffs.staff_ic = lab_bookings.lect_id
                                left join labs on labs.lab_id = lab_bookings.lab_id
                                where lab_bookings.stud_matric is null
                                and lab_bookings.status not in (:b)
                                and lab_bookings.end_date <= :end_date;');

            $this->db->bind(':b', 'pending');
            $this->db->bind(':end_date', date('Y-m-d'));

            $this->db->execute();

            return $this->db->resultSet();
        }
    }

    public function outsideRangeValidation($data)
    {
        $this->db->query('select count(booking_id) as row_count from lab_bookings where start_date >= :start_date
                            and end_date <= :end_date and lab_id = :lab_id 
                            and status=:status
                            and (start_time>=:start_time and end_time<=:end_time);');

        $this->db->bind(':start_date', $data['startDate']);
        $this->db->bind(':end_date', $data['endDate']);
        $this->db->bind(':lab_id', $data['lab_id']);
        $this->db->bind(':status', 'booked');
        $this->db->bind(':start_time', $data['startTime']);
        $this->db->bind(':end_time', $data['endTime']);

        $this->db->execute();

        if ($this->db->single()->row_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isAvailable($data)
    {
        $this->db->query('select * from lab_bookings where start_date >= :start_date
                            and end_date <= :end_date and lab_id = :lab_id and status=:status;');
        $this->db->bind(':start_date', $data['startDate']);
        $this->db->bind(':end_date', $data['endDate']);
        $this->db->bind(':lab_id', $data['lab_id']);
        $this->db->bind(':status', 'booked');

        $this->db->execute();

        $bookings = $this->db->resultSet();
        $input_start_time = $data['startTime'];
        $input_end_time = $data['endTime'];

        //loop through the existing bookings and check all cases

        foreach ($bookings as $bookings) {
            $start_time = $bookings->start_time;
            $end_time = $bookings->end_time;

            //case 1: if input timeslot is IN BETWEEN existing booked timeslot
            if ($input_start_time >= $start_time &&  $input_end_time <= $end_time) {
                return false;
            }

            //case 2: if input start_time is less than existing start_time AND
            //input end_time is more than existing start_time and less than existing end_time
            if ($input_start_time <= $start_time) {
                if ($input_end_time <= $end_time &&  $input_end_time > $start_time) {
                    return false;
                }
            }

            //case 3: if input end_time is more than existing end_time AND
            //input start_time is more/equal to existing start_time and less than existing end_time
            if ($input_end_time > $end_time && $input_start_time >= $start_time && $input_start_time < $end_time) {
                return false;
            }

            //case 4: if input start_time is less than existing start_time AND
            //input end_time is more than existing end_time
            if ($input_start_time <= $start_time &&  $input_end_time >= $end_time) {
                if ($this->outsideRangeValidation($data)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function labBookingAvailable($data)
    {
        if ($this->isAvailable($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllStudents()
    {
        $this->db->query('select * from students;');
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getAllStaffs()
    {
        $this->db->query('select * from staffs;');
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function deleteLab($lab_id)
    {
        $this->db->query('delete from inventories where lab_id=:lab_id');
        $this->db->bind(':lab_id', $lab_id);

        if ($this->db->execute()) {
            $this->db->query('delete from labs where lab_id=:lab_id');
            $this->db->bind(':lab_id', $lab_id);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteStudent($id)
    {
        $this->db->query('delete from students where stud_id = :id;');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addInventory($data)
    {
        $this->db->query('insert into inventories (inventory_name,quantity,lab_id,admin_id)
                          values (:inventory_name,:quantity,:lab_id,:admin_id);');
        $this->db->bind(':inventory_name', $data['inv_name']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':lab_id', $data['lab_id']);
        $this->db->bind(':admin_id', $data['admin_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteInventory($inv_id)
    {
        $this->db->query('delete from inventories where inventory_id = :id');
        $this->db->bind(':id', $inv_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateInventory($data)
    {
        $this->db->query('update inventories set inventory_name=:name, quantity=:quantity
                            where inventory_id=:inv_id;');
        $this->db->bind(':name', $data['inv_name']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':inv_id', $data['inv_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInventories($lab_id)
    {
        $this->db->query('select * from inventories where lab_id=:lab_id;');
        $this->db->bind(':lab_id', $lab_id);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getLabDetails($labid)
    {
        $this->db->query('select * from labs where lab_id=:id;');
        $this->db->bind(':id', $labid);
        $this->db->execute();

        return $this->db->single();
    }

    public function getAllLabs()
    {
        $this->db->query('select * from labs;');
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function deleteStaff($id)
    {
        $this->db->query('delete from staffs where id = :id;');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
