<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PasienController::index');
$routes->get('/table_pasien', 'PasienController::table_Pasien');
$routes->post('/save_pasien', 'PasienController::save_Pasien');
$routes->get('/get_pasien_id/(:segment)', 'PasienController::get_pasien_id/$1');
$routes->delete('/delete_pasien/(:segment)', 'PasienController::delete_Pasien/$1');

