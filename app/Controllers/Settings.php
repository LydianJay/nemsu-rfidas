<?php

namespace App\Controllers;

class Settings extends BaseController
{
    


    public function index()
    {
        $this->data['index']    = 2;
        echo view('header', $this->data);
        echo view('settings/form');
        echo view('footer');
    }


    public function update()
    {
        $current    = $this->request->getPost('current');
        $new        = $this->request->getPost('new');
        $confirm    = $this->request->getPost('confirm'); 


        $admin = $this->db
        ->table('admin')
        ->get()
        ->getResult()[0];

        $hashedCurrent = hash('sha256', $current);

        if($hashedCurrent != $admin->pass) {

            session()->setFlashdata('msg', 'Invalid current password');
            return redirect()->to(site_url('settings')); 
        }

        if (strlen($new) < 8) {
            session()->setFlashdata('msg', 'Password too weak');
            return redirect()->to(site_url('settings')); 
        }

        if ($new  != $confirm) {
            session()->setFlashdata('msg', 'Password does not match');
            return redirect()->to(site_url('settings')); 
        }
        

        $this->db
        ->table('admin')
        ->set('pass', hash('sha256', $new))
        ->update();


        session()->setFlashdata('msg', 'Update Success!');
        return redirect()->to(site_url('settings')); 
    }

    
}
