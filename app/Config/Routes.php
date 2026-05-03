<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::index');

$routes->get('alternatif', 'AlternatifController::index');
$routes->post('alternatif', 'AlternatifController::store');
$routes->post('alternatif/(:num)', 'AlternatifController::update/$1');
$routes->post('alternatif/(:num)/delete', 'AlternatifController::delete/$1');

$routes->get('kriteria', 'KriteriaController::index');
$routes->post('kriteria', 'KriteriaController::store');
$routes->post('kriteria/(:num)', 'KriteriaController::update/$1');
$routes->post('kriteria/(:num)/delete', 'KriteriaController::delete/$1');

$routes->get('penilaian', 'PenilaianController::index');
$routes->post('penilaian', 'PenilaianController::save');

$routes->get('perhitungan', 'PerhitunganController::index');
