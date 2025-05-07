<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true); // Mengaktifkan autoroute untuk mengabaikan error routing
$routes->get('/', 'Peserta::index');

// Rute Peserta 
$routes->group('peserta', function($routes) {
    $routes->get('/', 'Peserta::index');
    $routes->get('create', 'Peserta::create');
    $routes->post('store', 'Peserta::store');
    $routes->get('getData', 'Peserta::getData');
});
