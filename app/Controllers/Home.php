<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $private_data;

    public function __construct() 
    {
        $header = ['RFID', 'Last', 'First', 'Middle', 'Gender', 'Course', 'NSTP', 'Platoon'];

        for ($i = 0; $i < 4; $i++) {
            $header[] = 'In';
            $header[] = 'Out';
        }


        $this->private_data['table_head']  = $header;
    }

    private function get_saturdays()
    {
        $currentMonth = date('Y-m');
        $startDate = "$currentMonth-01";
        $endDate = date('Y-m-t'); // Last day of the current month

        $saturdays = [];
        $currentDate = strtotime($startDate);

        while ($currentDate <= strtotime($endDate)) {
            if (date('N', $currentDate) == 6) { // 6 represents Saturday
                $saturdays[] = date('d', $currentDate); // Only the day of the month
            }
            $currentDate = strtotime('+1 day', $currentDate);
        }

        return $saturdays;
    }


    private function get_attendance($month, $courseID, $nstpID)
    {
        $builder = $this->db
        ->table('attendance')
        ->select("*, course.id as course_id, nstp_course.name as nstp_name, course.name as course_name, attendance.rfid as rfid")
        ->join('students', 'attendance.rfid = students.rfid')
        ->join('course','students.courseID = course.id')
        ->join('nstp_course','students.nstpID = nstp_course.id')
        
        ->orderBy('attendance.rfid, day');
       

        $builder->where('month', $month);
    
        if($courseID != null) {
            $builder->where('course.id', $courseID);
        }

        if ($nstpID != null) {
            $builder->where('nstp_course.id', $nstpID);
        }


        $this->private_data['data'] = $builder->get()->getResult();
    }


    private function get_course()
    {
        $this->private_data['courses'] = $this->db
        ->table('course')
        ->get()
        ->getResult();

        $this->private_data['nstp_courses'] = $this->db
        ->table('nstp_course')
        ->get()
        ->getResult();
    }


    public function index()
    {
        $this->data['index']    = 0;
        $this->private_data['saturdays'] = $this->get_saturdays();
        
        $this->get_course();

        // === Filter
        
        $month                          = $this->request->getGet('month');
        $courseID                       = $this->request->getGet('course');
        $nstpID                         = $this->request->getGet('nstp');
        
        $this->private_data['nstp']     = $nstpID;
        $this->private_data['month']    = $month;
        $this->private_data['course']   = $courseID;
        if(isset($month)) {
            $this->get_attendance($month, $courseID, $nstpID);
        }
        else {
            $this->get_attendance(date('n'), $courseID, $nstpID);
        }


        $data       = $this->private_data['data'];
        $grouped    = [];

        foreach ($data as $d) {
            if (!isset($grouped[$d->rfid][$d->day])) {
                $grouped[$d->rfid][$d->day] = []; 
            }
            array_push($grouped[$d->rfid][$d->day], ['type' => $d->type]);            
        }

        $this->private_data['grouped'] = $grouped;


        echo view('header', $this->data);
        echo view('home/view', $this->private_data);
        echo view ('footer');
    }
}
