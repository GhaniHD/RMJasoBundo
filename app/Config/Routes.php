<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->post('/register', 'AuthController::registerAction');
$routes->post('/login', 'AuthController::loginAction');
$routes->get('menu', 'MenuController::index');

$routes->get('/pesanan', 'PesananController::index');
$routes->get('/pesanan/show/(:num)', 'PesananController::show/$1');

$routes->group('user', ['filter' => 'auth:user'], function ($routes) {
    $routes->post('pesanan/detail', 'PesananController::detail');
    $routes->get('dashboard', 'UserController::index');


    $routes->get('keranjang', 'KeranjangController::index');
    $routes->get('keranjang/add', 'KeranjangController::add');
    $routes->post('keranjang/add', 'KeranjangController::add');
    $routes->get('keranjang/edit/(:num)', 'KeranjangController::edit/$1');
    $routes->post('keranjang/update/(:num)', 'KeranjangController::update/$1');
    $routes->get('keranjang/delete/(:num)', 'KeranjangController::delete/$1');



    $routes->get('pembayaran', 'PembayaranController::upload');
    $routes->post('pembayaran/uploadAction', 'PembayaranController::uploadAction');


    $routes->get('pesanan', 'PesananController::lihatPesanan');
    $routes->post('pesanan/simpanPesanan', 'PesananController::simpanPesanan');
    $routes->post('pesanan/tambah', 'PesananController::tambah');


    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update/(:num)', 'ProfileController::update/$1');
});

$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');

    $routes->get('menu', 'MenuController::adminIndex');
    $routes->get('menu/create', 'MenuController::create');
    $routes->post('menu/store', 'MenuController::store');
    $routes->get('menu/edit/(:num)', 'MenuController::edit/$1');
    $routes->post('menu/update/(:num)', 'MenuController::update/$1');
    $routes->post('menu/delete/(:num)', 'MenuController::delete/$1');


    $routes->get('pesanan', 'PesananController::index');
    $routes->get('pesanan/create', 'PesananController::create');
    $routes->post('pesanan/store', 'PesananController::store');
    $routes->get('pesanan/edit/(:num)', 'PesananController::edit/$1');
    $routes->post('pesanan/update/(:num)', 'PesananController::update/$1');
    $routes->get('pesanan/delete/(:num)', 'PesananController::delete/$1');


    $routes->get('pembayaran', 'PembayaranController::index');
    $routes->get('pembayaran/show/(:num)', 'PembayaranController::show/$1');
    $routes->get('pembayaran/delete/(:num)', 'PembayaranController::delete/$1');
    $routes->post('pembayaran/update/(:num)', 'PembayaranController::update/$1');
    $routes->get('pembayaran/riwayat', 'PembayaranController::riwayat');


    $routes->get('user', 'AdminController::user');


    $routes->get('penjualan', 'PenjualanController::index');
    $routes->get('penjualan/laporanPenjualan', 'PenjualanController::laporanPenjualan');
    $routes->get('penjualan/laporanPenjualan/detail/(:num)', 'PenjualanController::detail/$1');
    $routes->post('penjualan/store', 'PenjualanController::store');
    $routes->post('penjualan/update/(:num)', 'PenjualanController::update/$1');
    $routes->get('penjualan/delete/(:num)', 'PenjualanController::delete/$1');
});
