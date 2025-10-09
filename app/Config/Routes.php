<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. DEBUG ROUTES (PALING ATAS)
$routes->get('debug/auth', 'Debug::auth');
$routes->get('debug/db-insert', 'Debug::testDbInsert');
$routes->get('debug/simple-post', 'Debug::testSimplePost');
$routes->post('debug/test-post', 'Debug::testPost');

// 2. TEST ROUTES  
$routes->get('test_db_connection.php', 'Test::dbConnection');

// 3. AUTH ROUTES
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// 4. CART ROUTES
$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update');
$routes->get('cart/remove/(:num)', 'Cart::remove/$1');

// 5. PRODUCT ROUTES
$routes->get('products', 'Home::products');
$routes->get('product/(:segment)', 'Home::productDetail/$1');

// 6. HOME ROUTE (PALING BAWAH)
$routes->get('/', 'Home::index');

// 7. CATCH-ALL (PALING PALING BAWAH - JIKA PERLU)
// $routes->get('(:any)', 'Home::index'); // ← COMMENT INI!