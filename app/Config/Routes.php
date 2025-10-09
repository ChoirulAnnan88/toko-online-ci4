<?php

use App\Controllers\UserController;

// Home Routes (existing)
    $routes->get('/', 'Home::index');
    $routes->get('products', 'Home::products');
    $routes->get('product/(:any)', 'Home::productDetail/$1');

// USER ROUTES - Pastikan tepat seperti ini
    $routes->group('user', function($routes) {
    $routes->get('create', [UserController::class, 'create']);
    $routes->post('store', [UserController::class, 'store']);
    $routes->get('success', [UserController::class, 'success']); // INI YANG PENTING!
    $routes->get('index', [UserController::class, 'index']);
    $routes->get('edit/(:num)', [UserController::class, 'edit']);
    $routes->post('update/(:num)', [UserController::class, 'update']);
});

// Auth Routes
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/processRegister', 'AuthController::processRegister');
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/processLogin', 'AuthController::processLogin');
$routes->get('auth/logout', 'AuthController::logout');

// User Routes (existing)
$routes->get('user', 'UserController::index');
$routes->get('user/create', 'UserController::create');
$routes->post('user/store', 'UserController::store');
$routes->get('user/success', 'UserController::success');

// Home page
$routes->get('/', function() {
    return redirect()->to(session()->has('logged_in') ? '/dashboard' : '/auth/login');
});

// Admin Routes
$routes->group('admin', function($routes) {
    $routes->get('users', 'Admin\UserManagement::users');
    $routes->get('users/edit/(:num)', 'Admin\UserManagement::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserManagement::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserManagement::delete/$1');
});

// User Profile Routes
$routes->get('profile', 'UserController::profile');
$routes->post('profile/update', 'UserController::updateProfile');