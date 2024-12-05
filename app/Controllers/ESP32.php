<?php

namespace App\Controllers;

class ESP32 extends BaseController
{

   

    public function index()
    {
       
        echo view('header', $this->data);
        echo view('footer');
    }


    public function insert()
    {
        $data   = $this->request->getJSON();

        $date   = date('m-d-Y');
        $splite = explode('-', $date);
        $time   = date('H:i');
        // $q2     = "SELECT COUNT(rfid) as n FROM attendance WHERE rfid = '$data->rfid' AND day = '$day' AND month = '$month' AND year = '$year' ";
        

        $month  = $splite[0];
        $day    = $splite[1];
        $year   = $splite[2];


        $isValid = $this->db->table('students')
        ->selectCount('rfid')
        ->where('rfid', $data->rfid)
        ->get()
        ->getResult();


        if($isValid[0]->rfid <= 0)  {

            return $this->response->setJSON(['status' => -1, 'msg' => 'Unregistered ID', 'user' => ' ']);
        
        }


        $count = $this->db->table('attendance')
        ->selectCount('rfid')
        ->where('rfid', $data->rfid)
        ->where('day', $day)
        ->where('month', $month)
        ->where('year', $year)
        ->get()
        ->getResult();

        $userInfo = $this->db->table('students')
        ->where('rfid', $data->rfid)
        ->get()
        ->getResult()[0];


        if($count[0]->rfid < 2 ) {

            $checkIns = $this->db->table('attendance')
                ->selectCount('rfid')
                ->where('rfid', $data->rfid)
                ->where('day', $day)
                ->where('month', $month)
                ->where('year', $year)
                ->where('type', 1)
                ->get()
                ->getResult()[0];

            

            $type = $checkIns->rfid >= 1 ? 0 : 1;
            
            $d = [
                'rfid'      => $data->rfid,
                'day'       => $day,
                'month'     => $month,
                'year'      => $year,
                'time'      => $time,
                'type'      => $type,
            ];

            $this->db->table('attendance')->insert($d);



            return $this->response
            ->setJSON(
                [
                    'status'    => 'OK', 
                    'msg'       => $type == 0 ? 'Time-Out' : 'Time-In',
                    'user'      => $userInfo->fname . ' ' . $userInfo->lname
                ]
            );
        }
        else {
            return $this->response
            ->setJSON(
                [
                    'status'        => 'OK',
                    'msg'           => 'Attendance Okay',
                    'user'          => $userInfo->fname . ' ' . $userInfo->lname
                ]
            );        
        }


    }
}
