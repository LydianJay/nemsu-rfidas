<?php

namespace App\Controllers;

use PhpParser\Node\Expr\FuncCall;

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

        $this->getCourses();
        $this->getNSTP();

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


        
        $birthdate = sprintf('%04d-%02d-%02d', $studentInfo->byear, $studentInfo->bmonth, $studentInfo->bday);
        $this->private_data['birthdate'] = $birthdate;
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
            'platoon',
        ];



        $postdata = [];

        foreach ($postmap as $p) {
            $data = $this->request->getPost($p);
            $postdata[$p] = $data;
            session()->setFlashdata($p, $data);
        }

        $birthdate  = $this->request->getPost('birthdate');
        $trim       = explode('-', $birthdate);

        $day        = $trim[2];
        $month      = $trim[1];
        $year       = $trim[0];


        $postdata['bday']       = $day;
        $postdata['bmonth']     = $month;
        $postdata['byear']      = $year;


        session()->setFlashdata('msg', 'Register Complete');
        $this->db->table('students')->insert($postdata);

        return redirect()->to(site_url('registration/form'));
    }


    public function update() 
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
            'platoon',
        ];

        $postdata = [];

        foreach ($postmap as $p) {
            $data = $this->request->getPost($p);
            $postdata[$p] = $data;
            session()->setFlashdata($p, $data);
        }

        $birthdate  = $this->request->getPost('birthdate');
        $rfid       = $this->request->getPost('orig_rfid');
        $trim       = explode('-', $birthdate);

        $day        = $trim[2];
        $month      = $trim[1];
        $year       = $trim[0];


        $postdata['bday']       = $day;
        $postdata['bmonth']     = $month;
        $postdata['byear']      = $year;

        echo $birthdate;

        $this->db->table('students')
        ->where('rfid', $rfid)
        ->set($postdata)
        ->update();

        session()->setFlashdata('msg', 'Update Complete');
        return redirect()->to(site_url('registration'));
    }
}
