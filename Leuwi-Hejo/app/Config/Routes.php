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
// $routes->get('/login', 'Auth::index');
// $routes->get('/register', 'Auth::register');




// Jendela 
$routes->get('/Jendela/(:segment)', 'Jendela::load/$1');
// $routes->get('/jendela/Reguler', 'jendela::Reguler');
// $routes->get('/jendela/trakking', 'Jendela::trakking');
// $routes->get('/jendela/curug', 'Jendela::curug');
// $routes->get('/jendela/paketCombo', 'Jendela::paketCombo');


// PopUP
$routes->get('/form/(:segment)', 'form::load/$1');

$routes->get('forbidden', 'Home::forbidden');



// admin
$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    // 'filter' => 'role:admin,super_admin',
    'filter' => 'liveadmin'
], function ($routes) {
    // beranda
    $routes->get('/', 'Dashboard::index',);
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

    // user
    $routes->get('user-panel', 'UserController::userPanel');
    $routes->get('profile', 'UserController::profile', ['filter' => 'login']);
    $routes->post('profile/update-info', 'UserController::updateInfo', ['filter' => 'login']);

    $routes->post('profile/update-image', 'UserController::updateImage', ['filter' => 'login']);
    $routes->post('profile/remove-image', 'UserController::removeImage', ['filter' => 'login']);
    $routes->get('daftar_user', 'UserController::index', ['filter' => 'login']);
    $routes->get('users/add', 'UserController::create');
    $routes->post('users/save', 'UserController::save');
    $routes->get('users/manage-roles', 'UserController::manageRoles');
    $routes->post('users/update-role', 'UserController::updateRole');
    $routes->post('users/toggle-status', 'UserController::toggleStatus');
    $routes->get('users/role-logs', 'UserController::roleLogs');
    $routes->get('users/delete/(:num)', 'UserController::deleteUser/$1', ['filter' => 'role:admin,super_admin']);
    $routes->get('refresh-role', 'UserController::refreshRole', ['filter' => 'login']);
});


$routes->group('admin/notifications', [
    'namespace' => 'App\Controllers\Admin',
    'filter' => 'liveadmin',
    // 'filter' => 'role:admin,super_admin',
], function ($routes) {
    $routes->get('/', 'NotificationController::index');
    $routes->get('read/(:num)', 'NotificationController::read/$1');
    $routes->get('cleanup', 'NotificationController::cleanup');
    $routes->get('ajax/get', 'NotificationController::getUserNotifications');       // 🔔 Get notifikasi AJAX
    $routes->post('ajax/mark-read', 'NotificationController::markUserNotifications'); // 🧼 Mark as read
    $routes->post('mark-read', 'NotificationController::markRead');
    $routes->post('mark-all-read', 'NotificationController::markAllRead');
});
