<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login', $this->data);
    }

    public function login()
    {
        $username   = $this->request->getPost('username');
        $password   = $this->request->getPost('password');
        $hashed     = hash('sha256', $password); 

        $result     =   $this->db
                        ->table('admin')
                        ->where('uname', $username)
                        ->where('pass', $hashed)
                        ->get()->getResult();

        
        if(count($result) < 1) {
            $this->setMessage('Invalid user or password');
            return redirect()->to(site_url(''));
        }
        else {
            session()->set('adminID', $result[0]->admin_id);
            // return redirect()->to(site_url('dashboard'));
            echo 'login success!';
        }
    }





}