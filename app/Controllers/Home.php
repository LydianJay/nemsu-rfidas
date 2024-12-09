<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $private_data;

    public function __construct() 
    {
        $header = ['RFID', 'Last', 'First', 'Middle', 'Gender', 'Course', 'NSTP', 'Platoon'];

        for ($i = 0; $i < 6; $i++) {
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


    private function get_attendance($month)
    {
        $this->private_data['data'] = $this->db
        ->table('attendance')
        ->select('*, course.id as course_id, nstp_course.name as nstp_name, course.name as course_name')
        ->join('students', 'attendance.rfid = students.rfid')
        ->join('course','students.courseID = course.id')
        ->join('nstp_course','students.nstpID = nstp_course.id')
        ->where('month', $month)
        ->get()
        ->getResult();
    }


    public function index()
    {
        $this->get_attendance();
        $this->data['index']    = 0;
        $this->private_data['saturdays'] = $this->get_saturdays();


        // === Filter
        
        $month                          = $this->request->getGet('month');
        $this->private_data['month']    = $month;
        if(isset($month)) {
            
        }


        echo view('header', $this->data);
        echo view('home/view', $this->private_data);
        echo view ('footer');
    }
}
