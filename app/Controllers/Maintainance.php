<?php

namespace App\Controllers;

class Maintainance extends BaseController
{
    public function index()
    {
        return view('maintainance/debug', $this->data);
    }

    
}
