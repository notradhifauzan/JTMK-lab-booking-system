<?php
class Staff
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function cancelBooking($booking_id)
    {
        $this->db->query('update lab_bookings set status=:status where booking_id = :id;');
        $this->db->bind(':status', 'cancelled');
        $this->db->bind(':id', $booking_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function myBookings($ic)
    {
        $this->db->query('select *,labs.lab_code as lab_code
                            from lab_bookings
                            left join labs on labs.lab_id = lab_bookings.lab_id
                            where lect_id=:ic;');
        $this->db->bind(':ic', $ic);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function isAvailable($data)
    {
        $this->db->query('select * from lab_bookings where start_date >= :start_date
                            and end_date <= :end_date and lab_id = :lab_id and status=:status;');
        $this->db->bind(':start_date', $data['startDate']);
        $this->db->bind(':end_date', $data['endDate']);
        $this->db->bind(':lab_id', $data['lab']->lab_id);
        $this->db->bind(':status', 'booked');

        $this->db->execute();

        $bookings = $this->db->resultSet();

        foreach ($bookings as $bookings) {
            $start_time = $bookings->start_time;
            $end_time = $bookings->end_time;

            //case 1: if input timeslot is IN BETWEEN existing booked timeslot
            if ($data['startTime'] >= $start_time && $data['endTime'] <= $end_time) {
                return false;
            }

            //case 2: if input start_time is less than existing start_time AND
            //input end_time is more than existing start_time and less than existing end_time
            if ($data['startTime'] <= $start_time) {
                if ($data['endTime'] <= $end_time && $data['endTime'] > $start_time) {
                    return false;
                }
            }

            //case 3: if input end_time is more than existing end_time AND
            //input start_time is more/equal to existing start_time and less than existing end_time
            if ($data['endTime'] > $end_time && $data['startTime'] >= $start_time && $data['startTime'] < $end_time) {
                return false;
            }

            //case 4: if input start_time is less than existing start_time AND
            //input end_time is more than existing end_time
            if ($data['startTime'] <= $start_time && $data['endTime'] >= $end_time) {
                if ($this->outsideRangeValidation($data)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function outsideRangeValidation($data)
    {
        $this->db->query('select * from lab_bookings where start_date >= :start_date
                            and end_date <= :end_date and lab_id = :lab_id 
                            and status=:status
                            and (start_time>=:start_time and end_time<=:end_time);');

        $this->db->bind(':start_date', $data['startDate']);
        $this->db->bind(':end_date', $data['endDate']);
        $this->db->bind(':lab_id', $data['lab']->lab_id);
        $this->db->bind(':status', 'booked');
        $this->db->bind(':start_time', $data['startTime']);
        $this->db->bind(':end_time', $data['endTime']);

        $this->db->execute();

        if ($this->db->rowCount() > 0) return true;
        else return false;
    }

    public function labBookingAvailable($data)
    {
        if ($this->isAvailable($data)) {
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

    public function labBooking($data)
    {
        $this->db->query('insert into lab_bookings (lab_id,lect_id,start_date,end_date,start_time,end_time,purpose,participants)
                            values(:lab_id,:staff_ic,:startDate,:endDate,:startTime,:endTime,:purpose,:participants);');

        $this->db->bind(':staff_ic', $data['staff_ic']);
        $this->db->bind(':purpose', $data['purpose']);
        $this->db->bind(':participants', $data['participants']);

        $this->db->bind(':lab_id', $data['lab']->lab_id);
        $this->db->bind(':startDate', $data['startDate']);
        $this->db->bind(':endDate', $data['endDate']);
        $this->db->bind(':startTime', $data['startTime']);
        $this->db->bind(':endTime', $data['endTime']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllLabs()
    {
        $this->db->query('select * from labs;');
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function login($ic, $password)
    {
        //finding the user with that username
        $this->db->query('SELECT * FROM staffs WHERE staff_ic=:ic;');
        $this->db->bind(':ic', $ic);
        //single method will return the whole row as object
        //so you can treat $row as an object, and access the password

        $row = $this->db->single();

        $hashed_password = $row->staff_password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function findStaffByIC($nric)
    {
        $this->db->query('select * from staffs where staff_ic =:nric;');
        $this->db->bind(':nric', $nric);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findStaffByPhone($phone)
    {
        $this->db->query('select * from staffs where staff_phone =:phone;');
        $this->db->bind(':phone', $phone);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findStaffByEmail($email)
    {
        $this->db->query('select * from staffs where staff_email =:email;');
        $this->db->bind(':email', $email);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('insert into staffs (staff_ic,staff_name,staff_phone,staff_email,
                          staff_password)
                          
                          values (:staff_ic,:staff_name,:staff_phone,:staff_email,
                                  :staff_password);');

        $this->db->bind(':staff_ic', $data['nric']);
        $this->db->bind(':staff_name', $data['name']);
        $this->db->bind(':staff_phone', $data['phone']);
        $this->db->bind(':staff_email', $data['email']);
        $this->db->bind(':staff_password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
