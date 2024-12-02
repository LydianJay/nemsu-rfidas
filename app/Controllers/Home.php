<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $private_data;

    public function __construct() 
    {
        $this->private_data['table_head']  = ['RFID', 'First', 'Middle', 'Last', 'Gender', 'Course', 'NSTP'];
    }


    private function get_attendance()
    {
        $this->private_data['data'] = $this->db
        ->table('attendance')
        ->select('*, course.id as course_id, nstp_course.name as nstp_name, course.name as course_name')
        ->join('students', 'attendance.rfid = students.rfid')
        ->join('course','students.courseID = course.id')
        ->join('nstp_course','students.nstpID = nstp_course.id')
        ->get()
        ->getResult();
    }


    public function index()
    {
        $this->get_attendance();
        echo view('header', $this->data);
        echo view('home/view', $this->private_data);
        echo view ('footer');
    }
}
