<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home Routes
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/products', 'Home::products');
$routes->get('/product/(:segment)', 'Home::productDetail/$1');

// Auth Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
});

// Cart Routes
$routes->group('cart', function($routes) {
    $routes->get('/', 'Cart::index');
    $routes->post('add', 'Cart::add');
    $routes->post('update', 'Cart::update');
    $routes->get('remove/(:num)', 'Cart::remove/$1');
});

// Admin Routes (untuk development selanjutnya)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

// Default Controller
$routes->get('(:any)', 'Home::index');