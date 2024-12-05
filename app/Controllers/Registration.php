<?php

namespace App\Controllers;

class Registration extends BaseController
{

    private $private_data;

    public function __construct()
    {
        $this->private_data['table_head']  = ['RFID', 'Last', 'First', 'Middle', 'Gender', 'Course', 'NSTP', 'Section'];
    }

    private function getstudents() 
    {

        $this->private_data['data'] = $this->db->table('students')
        ->select('*, nstp_course.name as nstp_name, course.name as course_name')
        ->join('course', 'course.id = students.courseID')
        ->join('nstp_course', 'nstp_course.id = students.nstpID')
        ->get()
        ->getResult();
    }


    private function getCourses() 
    {
        $this->private_data['courses'] = $this->db->table('course')->get()->getResult(); 
    }

    private function getNSTP()
    {
        $this->private_data['nstp_courses'] = $this->db->table('nstp_course')->get()->getResult();
    }


    public function index()
    {

        $this->getstudents();
        $this->data['index']    = 1;
        echo view('header', $this->data);
        echo view('registration/view', $this->private_data);
        echo view('footer');
    }

    public function form()
    {
        $this->getCourses();
        $this->getNSTP();
        $this->data['index']    = 1;
        echo view('header', $this->data);
        echo view('registration/form', $this->private_data);
        echo view('footer');
    }

    public function userinfo($rfid)
    {

        $studentInfo = $this->db->table('students')
        ->where('rfid', $rfid)
        ->get()
        ->getResult()[0];


        $course = $this->db->table('course')
        ->where('id', $studentInfo->courseID)
        ->get()
        ->getResult()[0];

        $nstp = $this->db->table('nstp_course')
        ->where('id', $studentInfo->nstpID)
        ->get()
        ->getResult()[0];


        $this->private_data['student']      = $studentInfo;
        $this->private_data['nstp']         = $nstp;
        $this->private_data['course']       = $course;
        
        
        $this->data['index']    = 1;
        echo view('header', $this->data);
        echo view('registration/info', $this->private_data);
        echo view('footer');
    }

    public function register()
    {
        $postmap = [
            'fname',
            'lname',
            'mname',
            'rfid',
            'courseID',
            'nstpID',
            'gender',
            'section',
        ];



        $postdata = [];

        foreach ($postmap as $p) {
            $data = $this->request->getPost($p);
            $postdata[$p] = $data;
            session()->setFlashdata($p, $data);
        }

        $birthdate  = $this->request->getPost('birthdate');
        $trim       = explode('-', $birthdate);

        $day        = $trim[0];
        $month      = $trim[1];
        $year       = $trim[2];


        $postdata['bday']       = $day;
        $postdata['bmonth']     = $month;
        $postdata['byear']      = $year;


        session()->setFlashdata('msg', 'Register Complete');
        $this->db->table('students')->insert($postdata);

        return redirect()->to(site_url('registration/form'));
    }
}
