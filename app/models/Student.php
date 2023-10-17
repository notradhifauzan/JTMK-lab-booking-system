<?php
class Student
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($matric, $password)
    {
        //finding the user with that username
        $this->db->query('SELECT * FROM students WHERE matric_id=:matric_id;');
        $this->db->bind(':matric_id', $matric);
        //single method will return the whole row as object
        //so you can treat $row as an object, and access the password

        $row = $this->db->single();

        $hashed_password = $row->stud_password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function usernameExist($matric_id)
    {
        $this->db->query('select * from students where matric_id=:matric_id;');
        $this->db->bind(':matric_id', $matric_id);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findStudentByIC($nric)
    {
        $this->db->query('select * from students where stud_ic =:nric;');
        $this->db->bind(':nric', $nric);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findStudentByPhone($phone)
    {
        $this->db->query('select * from students where stud_phone =:phone;');
        $this->db->bind(':phone', $phone);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findStudentByEmail($email)
    {
        $this->db->query('select * from students where stud_email =:email;');
        $this->db->bind(':email', $email);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
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

    public function myBookings($matric_id)
    {
        $this->db->query('select *,labs.lab_code as lab_code
                            from lab_bookings
                            left join labs on labs.lab_id = lab_bookings.lab_id
                            where stud_matric=:id;');
        $this->db->bind(':id', $matric_id);
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
                if($this->outsideRangeValidation($data)){
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

    public function labBooking($data)
    {
        $this->db->query('insert into lab_bookings (lab_id,stud_matric,supervisor,start_date,end_date,start_time,end_time,purpose,participants)
                            values(:lab_id,:stud_matric,:supervisor,:startDate,:endDate,:startTime,:endTime,:purpose,:participants);');

        $this->db->bind(':stud_matric', $data['matric_id']);
        $this->db->bind(':supervisor', $data['supervisor']);
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

    public function register($data)
    {
        $this->db->query('insert into students (stud_ic,stud_name,stud_phone,stud_semester,
                          stud_course,stud_class,stud_email,year_enroll,study_mode,session_enroll,
                          stud_password)
                          
                          values (:stud_ic,:stud_name,:stud_phone,:stud_semester,
                                  :stud_course,:stud_class,:stud_email,:year_enroll,:study_mode,:session_enroll,
                                  :stud_password);');

        $this->db->bind(':stud_ic', $data['nric']);
        $this->db->bind(':stud_name', $data['name']);
        $this->db->bind(':stud_phone', $data['phone']);
        $this->db->bind(':stud_semester', $data['semester']);
        $this->db->bind(':stud_course', $data['course']);
        $this->db->bind(':stud_class', $data['class']);
        $this->db->bind(':stud_email', $data['email']);
        $this->db->bind(':year_enroll', $data['year_enroll']);
        $this->db->bind(':study_mode', $data['study_mode']);
        $this->db->bind(':session_enroll', $data['session_enroll']);
        $this->db->bind(':stud_password', $data['password']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return 0;
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

    public function insertMatricId($id, $matric)
    {
        $this->db->query('update students set matric_id=:matric_id where stud_id=:id;');
        $this->db->bind(':matric_id', $matric);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
