<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Route yang dilindungi filter auth (harus login dulu)
$routes->get('/produk', 'ProdukController::index', ['filter' => 'auth']);
$routes->get('/keranjang', 'TransaksiController::index', ['filter' => 'auth']);

// Route front
$routes->get('front/(:any)', 'Main::front/$1');  

// Route autentikasi (tanpa filter)
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// Route kuliner publik
$routes->get('kuliner',            'KulinerController::index');
$routes->get('kuliner/tambah',     'KulinerController::tambah',  ['filter' => 'auth']);
$routes->post('kuliner/simpan',    'KulinerController::simpan',  ['filter' => 'auth']);
$routes->get('kuliner/(:segment)', 'KulinerController::detail/$1');


// Route admin
$routes->get('admin/kuliner', 'KulinerController::adminIndex', ['filter' => 'App\Filters\AdminFilter']);
$routes->post('admin/kuliner/status/(:num)',         'KulinerController::updateStatus/$1', ['filter' => 'admin']);
$routes->get('admin/kuliner/hapus/(:num)',           'KulinerController::hapus/$1',        ['filter' => 'admin']);
$routes->post('review/simpan/(:num)', 'ReviewController::simpan/$1', ['filter' => 'auth']);
$routes->get('api/kuliner',      'Api\KulinerApi::index');
$routes->get('api/kuliner/(:num)', 'Api\KulinerApi::show/$1');
$routes->get('register',  'AuthController::register');
$routes->post('register', 'AuthController::register');

// profile 
$routes->get('profile', 'KulinerController::profile');

$routes->post('notifikasi/baca-semua', 'NotificationController::bacaSemua', ['filter' => 'auth']);