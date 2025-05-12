<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'pages::index');
$routes->get('/pages/about', 'pages::about');
$routes->get('/pages/galery', 'Pages::galery');
$routes->get('/pages/pesanTiket', 'Pages::pesanTiket');

// authentication
$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');




// Jendela 
$routes->get('/Jendela/(:segment)', 'Jendela::load/$1');
// $routes->get('/jendela/Reguler', 'jendela::Reguler');
// $routes->get('/jendela/trakking', 'Jendela::trakking');
// $routes->get('/jendela/curug', 'Jendela::curug');
// $routes->get('/jendela/paketCombo', 'Jendela::paketCombo');


// PopUP
$routes->get('/form/(:segment)', 'form::load/$1');


// admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // beranda
    $routes->get('/', 'Dashboard::index');
    $routes->get('beranda', 'Beranda::index');
    $routes->get('beranda/edit/(:segment)', 'Beranda::edit/$1');
    $routes->post('beranda/update/(:segment)', 'Beranda::update/$1');

    // bagian editing gambar
    $routes->get('beranda/edit-gambar/(:num)', 'Beranda::editGambar/$1');
    $routes->post('beranda/update-gambar/(:num)', 'Beranda::updateGambar/$1');
    $routes->post('beranda/hapus-gambar/(:num)', 'Beranda::hapusGambar/$1');
    $routes->get('beranda/tambah-gambar', 'Beranda::tambahGambar');
    $routes->post('beranda/tambah-gambar', 'Beranda::simpanGambar');

    // bagian editing media

    $routes->get('beranda/tambah-media', 'Beranda::tambahMedia');
    $routes->post('beranda/simpan-media', 'Beranda::simpanMedia');
    $routes->get('beranda/edit-media/(:num)', 'Beranda::editMedia/$1');
    $routes->post('beranda/update-media/(:num)', 'Beranda::updateMedia/$1');
    $routes->post('beranda/hapus-media/(:num)', 'Beranda::hapusMedia/$1');



    // tentang kami
    $routes->get('tentang_kami', 'TentangKami::index');
    $routes->get('tentang_kami/edit/(:segment)', 'TentangKami::edit/$1');
    $routes->post('tentang_kami/update/(:segment)', 'TentangKami::update/$1');
});
