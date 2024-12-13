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
        $header[] = 'Total';


        $this->private_data['table_head']  = $header;
    }

    private function bechex($number)
    {
        $hex = '';
        while (bccomp($number, '0') > 0) {
            $remainder = bcmod($number, '16');
            $hex = dechex($remainder) . $hex;
            $number = bcdiv($number, '16', 0);
        }
        return $hex ?: '0'; 
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


    // Temp function --- FOR DEBUG ONLY ---
    private function get_next_three_days()
    {
        $currentDate = date('Y-m-d'); // Current date in 'Y-m-d' format
        $threeDays = [];

        for ($i = 0; $i < 3; $i++) {
            $threeDays[] = date('Y-m-d', strtotime("+$i day", strtotime($currentDate)));
        }

        return $threeDays;
    }

    


    private function get_attendance($month, $courseID, $nstpID, $platoon)
    {
        $builder = $this->db
        ->table('attendance')
        ->select("*, course.id as course_id, nstp_course.name as nstp_name, course.name as course_name, attendance.rfid as rfid")
        ->join('students', 'attendance.rfid = students.rfid')
        ->join('course','students.courseID = course.id')
        ->join('nstp_course','students.nstpID = nstp_course.id')
        
        ->orderBy('attendance.rfid, day');
        

        if($month != null) {
            $builder->where('month', $month);
        }

        if($platoon != null){
            $builder->where('platoon', $platoon);
        }

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
        $this->private_data['saturdays']    = $this->get_next_three_days(); // For DEBUG only!
        // $this->private_data['saturdays']    = $this->get_saturdays(); // Disabled Temporarily 
        
        $this->get_course();

        // === Filter
        
        $month                          = $this->request->getGet('month')   == 0 ? null : $this->request->getGet('month');
        $courseID                       = $this->request->getGet('course')  == 0 ? null : $this->request->getGet('course');
        $nstpID                         = $this->request->getGet('nstp')    == 0 ? null : $this->request->getGet('nstp');
        $platoon                        = $this->request->getGet('platoon') == 0 ? null : $this->request->getGet('platoon');


        $this->private_data['nstp']     = $nstpID;
        $this->private_data['month']    = $month;
        $this->private_data['course']   = $courseID;
        $this->private_data['plat']     = $platoon;
        if(isset($month)) {
            $this->get_attendance($month, $courseID, $nstpID, $platoon);
        }
        else {
            $this->get_attendance(date('n'), $courseID, $nstpID, $platoon);
        }


        $data       = $this->private_data['data'];
        $grouped    = [];
        $total      = [];
        $hex        = [];

        foreach ($data as $d) {
            
            $hex[$d->rfid] = $this->bechex($d->rfid);
            if (!isset($grouped[$d->rfid][$d->day])) {
                $grouped[$d->rfid][$d->day] = []; 
            }

            if(!isset($total[$d->rfid])){
                $total[$d->rfid] = 0;
            }

            array_push($grouped[$d->rfid][$d->day], ['type' => $d->type]);            
            $total[$d->rfid] += 0.5;
        }

        $this->private_data['grouped']  = $grouped;
        $this->private_data['total']    = $total;
        $this->private_data['hex']      = $hex;


        echo view('header', $this->data);
        echo view('home/view', $this->private_data);
        echo view ('footer');
    }


    public function logout()
    {

        return redirect()->to(site_url(''));
    }
}
