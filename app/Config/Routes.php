<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* ===================== AUTH ===================== */

$routes->get('/', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

/* ===================== DASHBOARD ===================== */

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

/* ===================== KATEGORI ===================== */
$routes->group('category', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'CategoryController::index');
    $routes->get('create', 'CategoryController::create');
    $routes->post('store', 'CategoryController::store');
    $routes->get('edit/(:num)', 'CategoryController::edit/$1');
    $routes->post('update/(:num)', 'CategoryController::update/$1');
    $routes->get('delete/(:num)', 'CategoryController::delete/$1');
});

/* ===================== ACTIVITY LOG ===================== */

$routes->get('/activity-log', 'ActivityLogController::index', ['filter' => 'auth']);

/* ===================== PROFILE ===================== */

$routes->group('profile', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->get('edit', 'ProfileController::edit');
    $routes->post('update', 'ProfileController::update');
    $routes->post('update-password', 'ProfileController::updatePassword');
});

/* ===================== USER (ADMIN) ===================== */

$routes->group('user', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

/* ===================== ALAT ===================== */

$routes->group('alat', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AlatController::index');
});

$routes->group('alat', ['filter' => 'admin'], function ($routes) {
    $routes->get('create', 'AlatController::create');
    $routes->post('store', 'AlatController::store');
    $routes->get('edit/(:num)', 'AlatController::edit/$1');
    $routes->post('update/(:num)', 'AlatController::update/$1');
    $routes->get('delete/(:num)', 'AlatController::delete/$1');
});

/* ===================== PEMINJAMAN (SEMUA ROLE) ===================== */

/*
🔥 INI YANG DIGANTI TOTAL
Semua pakai 1 function: dataPeminjaman
*/

$routes->get('peminjaman', 'PeminjamanController::dataPeminjaman', ['filter' => 'auth']);
$routes->get('petugas/peminjaman', 'PeminjamanController::dataPeminjaman', ['filter' => 'auth']);
$routes->get('admin/peminjaman', 'PeminjamanController::dataPeminjaman', ['filter' => 'admin']);

/* ===================== AKSI PEMINJAMAN ===================== */

$routes->group('peminjaman', ['filter' => 'auth'], function ($routes) {
    $routes->get('create/(:num)', 'PeminjamanController::create/$1');
    $routes->post('store', 'PeminjamanController::store');
    $routes->get('kembalikan/(:num)', 'PeminjamanController::ajukanPengembalian/$1');
});

/* ===================== PETUGAS ===================== */

$routes->group('petugas', ['filter' => 'auth'], function ($routes) {
    $routes->get('setujui/(:num)', 'PeminjamanController::setujui/$1');
    $routes->get('tolak/(:num)', 'PeminjamanController::tolak/$1');
    $routes->post('proses-tolak/(:num)', 'PeminjamanController::prosesTolak/$1');

    $routes->get('pengembalian', 'PeminjamanController::listPengembalianPetugas');
    $routes->get('validasi/(:num)', 'PeminjamanController::validasiPengembalian/$1');
    $routes->get('laporan/pengembalian/(:num)', 'PeminjamanController::cetakLaporanPengembalian/$1');
});

/* ===================== ADMIN ACTION ===================== */

$routes->group('admin/peminjaman', ['filter' => 'admin'], function ($routes) {
    $routes->get('edit/(:num)', 'PeminjamanController::edit/$1');
    $routes->post('update/(:num)', 'PeminjamanController::update/$1');
    $routes->get('delete/(:num)', 'PeminjamanController::delete/$1');
});

/* ===================== TEST ===================== */

$routes->get('/testdb', 'TestDb::index');