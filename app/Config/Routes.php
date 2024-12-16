<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login');


// Home 
$routes->get('/home', 'Home::index');


// In Development
$routes->get('/indev', 'Maintainance::index');

// Settings
$routes->get('/settings', 'Settings::index');
$routes->post('/update',  'Settings::update');

// ESP32
$routes->post('/insert', 'ESP32::insert');
// $routes->get('/insert', 'ESP32::insert');

$routes->get('/logout', 'Home::logout');

// ============= Students ==================
$routes->get('/registration',           'Registration::index');
$routes->get('/registration/form',      'Registration::form');
$routes->post('/registration/update',   'Registration::update');
$routes->post('/register',              'Registration::register');
$routes->get('/userinfo/(:num)',        'Registration::userinfo/$1');
$routes->get('/delete/(:num)',          'Registration::delete/$1');