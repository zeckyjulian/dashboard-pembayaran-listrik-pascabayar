<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Listrik::login');

// Authentication Routes
$routes->get('/login', 'Listrik::login');
$routes->get('/logout', 'Listrik::logout');
$routes->post('/autentikasi-login', 'Listrik::autentikasi');

// Admin
$routes->get('admin/login', 'Admin::login');
$routes->get('admin/logout', 'Admin::logout');
$routes->post('admin/autentikasi-admin', 'Admin::autentikasi');
$routes->get('admin/dashboard-admin', 'Admin::dashboard_admin');
$routes->get('admin/tagihan-pelanggan', 'Admin::tagihan_pelanggan');

// Listrik Routes
$routes->get('/dashboard', 'Listrik::dashboard');
$routes->get('/kalkulasi-pembayaran', 'Listrik::kalkulasi');
$routes->get('/listrik-bulanan', 'Listrik::penggunaan_bulanan');
$routes->post('/simpan-penggunaan', 'Listrik::simpan_penggunaan');
$routes->get('/edit-penggunaan/(:alphanum)', 'Listrik::edit_penggunaan/$1');
$routes->post('/update-penggunaan', 'Listrik::update_penggunaan');
$routes->get('/tagihan-listrik', 'Listrik::tagihan_listrik');

// Admin Pelanggan
$routes->get('admin/data-pelanggan', 'Pelanggan::master_data_pelanggan');
$routes->get('admin/input-pelanggan', 'Pelanggan::input_data_pelanggan');
$routes->post('admin/simpan-pelanggan', 'Pelanggan::simpan_data_pelanggan');
$routes->get('admin/edit-pelanggan/(:alphanum)', 'Pelanggan::edit_data_pelanggan/$1');
$routes->post('admin/update-pelanggan', 'Pelanggan::update_data_pelanggan');
$routes->get('admin/hapus-pelanggan/(:alphanum)', 'Pelanggan::hapus_data_pelanggan/$1');

// Pembayaran Routes
$routes->get('/pembayaran/(:alphanum)', 'Listrik::pembayaran/$1');
$routes->post('pembayaran/proses/(:alphanum)', 'Listrik::prosesPembayaran/$1');
