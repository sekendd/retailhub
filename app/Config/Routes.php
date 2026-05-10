<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::attempt');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/products', 'Products::index');
$routes->get('/products/create', 'Products::create');
$routes->post('/products/store', 'Products::store');
$routes->get('/products/edit/(:num)', 'Products::edit/$1');
$routes->post('/products/update/(:num)', 'Products::update/$1');
$routes->get('/products/delete/(:num)', 'Products::delete/$1');
$routes->post('/products/delete/(:num)', 'Products::delete/$1');

$routes->get('/variants/(:num)', 'Variants::index/$1');
$routes->get('/variants/create/(:num)', 'Variants::create/$1');
$routes->post('/variants/store', 'Variants::store');

$routes->get('/sales', 'Sales::index');
$routes->post('/sales/checkout', 'Sales::checkout');

$routes->get('/returns', 'Returns::index');
$routes->post('/returns/store', 'Returns::store');

$routes->get('/api/products', 'Api::products');
$routes->get('/api/stock/(:num)', 'Api::stock/$1');