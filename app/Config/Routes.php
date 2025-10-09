<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Debug Routes - TAMBAH INI!
$routes->get('debug/auth', 'Debug::auth');
$routes->match(['get', 'post'], 'debug/test-register', 'Debug::testRegister');


// Home Routes
$routes->get('/', 'Home::index');
$routes->get('/products', 'Home::products');
$routes->get('/product/(:segment)', 'Home::productDetail/$1');

// Auth Routes - PASTIKAN INI ADA
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// Cart Routes
$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update');
$routes->get('cart/remove/(:num)', 'Cart::remove/$1');

// Fallback
$routes->get('(:any)', 'Home::index');