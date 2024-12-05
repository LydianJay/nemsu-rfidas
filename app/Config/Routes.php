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


// ESP32
$routes->post('/insert', 'ESP32::insert');
$routes->get('/insert', 'ESP32::index');