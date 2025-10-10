<?php
namespace Config;

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */

// Profile Routes
$routes->get('profile', 'ProfileController::index');
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');
$routes->get('profile/change-password', 'ProfileController::changePassword');
$routes->post('profile/update-password', 'ProfileController::updatePassword');
$routes->get('profile/orders', 'ProfileController::orders');
$routes->get('profile/order/(:num)', 'ProfileController::orderDetail');

// Admin Routes
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/products', 'Admin::products');
$routes->get('admin/categories', 'Admin::categories');
$routes->get('admin/orders', 'Admin::orders');
$routes->get('admin/users', 'Admin::users');
$routes->post('admin/orders/update-status/(:num)', 'Admin::updateOrderStatus');

// Existing Auth Routes
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/processRegister', 'Auth::processRegister');
$routes->get('auth/logout', 'Auth::logout');

// Home route
$routes->get('/', 'Home::index');