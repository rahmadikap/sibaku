<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');
$routes->post('home/save', 'Home::save');
$routes->get('/login', 'Login::index');
/*$routes->get('/register', 'Register::index');
$routes->post('/register/create', 'Register::create');*/
$routes->post('/login', 'Login::authenticate');
/*$routes->get('admin/dashboard', 'Dashboard::index', ['filter' => 'auth']);// Apply the auth filter
$routes->get('dashboard/getBooksByMonth/(:num)', 'Dashboard::getBooksByMonth/$1');
$routes->get('dashboard/getBooksByYear', 'Dashboard::getBooksByYear');*/
$routes->get('admin/data', 'Data::index', ['filter' => 'auth']);
$routes->get('admin/laporan', 'Laporan::index');
$routes->get('admin/laporan/downloadLaporanPdf', 'Laporan::downloadLaporanPdf');
$routes->get('admin/laporan/downloadLaporanExcel', 'Laporan::downloadLaporanExcel');
$routes->get('admin/users', 'User::index');
$routes->get('admin/users/create', 'User::create');
$routes->post('admin/users/store', 'User::store');
$routes->post('admin/users/edit', 'User::edit');
$routes->post('admin/users/update', 'User::update');
$routes->post('admin/users/delete', 'User::delete');
$routes->get('/login/logout', 'Login::logout');
/*$routes->get('dashboard', 'Admin::dashboard', ['filter' => 'auth']); // Apply the auth filter
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'auth']);
$routes->get('admin/dashboard', 'Admin\Dashboard::index');
$routes->get('admin/dashboard/downloadLaporan', 'Admin\Dashboard::downloadLaporan');*/