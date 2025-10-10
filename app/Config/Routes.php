<?php
use App\Controllers\Admin;
use App\Controllers\ProfileController;

namespace Config;

// Routes to one of the main controllers
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Profile Routes
$routes->get('profile', [ProfileController::class, 'index']);
$routes->get('profile/edit', [ProfileController::class, 'edit']);
$routes->post('profile/update', [ProfileController::class, 'update']);
$routes->get('profile/change-password', [ProfileController::class, 'changePassword']);
$routes->post('profile/update-password', [ProfileController::class, 'updatePassword']);
$routes->get('profile/orders', [ProfileController::class, 'orders']);
$routes->get('profile/order/(:num)', [ProfileController::class, 'orderDetail']);

// Admin Routes
$routes->get('admin/dashboard', [Admin::class, 'dashboard']);
$routes->get('admin/products', [Admin::class, 'products']);
$routes->get('admin/categories', [Admin::class, 'categories']);
$routes->get('admin/orders', [Admin::class, 'orders']);
$routes->get('admin/users', [Admin::class, 'users']);
$routes->post('admin/orders/update-status/(:num)', [Admin::class, 'updateOrderStatus']);

// Existing Auth Routes (keep these)
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/processRegister', 'Auth::processRegister');
$routes->get('auth/logout', 'Auth::logout');

// Home route
$routes->get('/', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}