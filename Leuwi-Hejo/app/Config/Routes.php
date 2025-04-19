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


// Jendela 
$routes->get('/jendela/Reguler', 'Jendela::Reguler');
$routes->get('/jendela/trakking', 'Jendela::trakking');
$routes->get('/jendela/curug', 'Jendela::curug');
$routes->get('/jendela/paketCombo', 'Jendela::paketCombo');


// PopUP
$routes->get('/form/(:segment)', 'form::load/$1');


// admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('beranda', 'Beranda::index');
    $routes->get('tentang_kami', 'Beranda::tentang_kami');
    $routes->get('galery', 'Beranda::galery');
    $routes->get('produk_paket', 'Beranda::produk_paket');
});
