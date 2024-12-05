<?php

namespace App\Controllers;

use DateTime;

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
        

        $month  = $splite[0];
        $day    = $splite[1];
        $year   = $splite[2];

        $start_time     = "07:20"; 
        $end_time       = "11:00"; 
        $current_time   = date('H:i');


        $afternoon_start_time     = "01:00";
        $afternoon_end_time       = "16:00";

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

            if ($type == 1 && !($current_time >= $start_time && $current_time <= $end_time)) {
                return $this->response
                    ->setJSON(
                        [
                            'status'    => 'OK',
                            'msg'       => 'Too Late/Early',
                            'user'      => $userInfo->fname . ' ' . $userInfo->lname
                        ]
                    );
            }


            if ($type == 0 && !($current_time >= $afternoon_start_time && $current_time <= $afternoon_end_time)) {
                return $this->response
                    ->setJSON(
                        [
                            'status'    => 'OK',
                            'msg'       => 'Too Late/Early',
                            'user'      => $userInfo->fname . ' ' . $userInfo->lname
                        ]
                    );
            }



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

        return redirect()->to(site_url('admin/dental'));
    }
}
