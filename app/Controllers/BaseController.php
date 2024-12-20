<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;
    protected $data;
    protected $db;
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->db           = \Config\Database::connect();
        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        
        $this->data['app_title']        = 'NEMSU-RFIDAS';
        $this->data['company_name']     = 'NEMSU-RFIDAS';

        $this->data['modules']  = [

            [
                'icon'  => 'bi bi-grid',
                'title' => 'Attendance',
                'uri'   => 'home'
            ],

            [
                'icon'  => 'bi bi-person-lines-fill',
                'title' => 'Students',
                'uri'   => 'registration'
            ],

            [
                'icon'  => 'bi bi-gear-fill',
                'title' => 'Settings',
                'uri'   => 'settings'
            ],

        ];
    }


    public function setMessage($msg)
    {
        session()->setFlashdata('msg', $msg);
    }
    
    public function getMessage()
    {
        return session()->getFlashdata('msg');
    }
}   