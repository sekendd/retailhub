<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');    

// Authenticated routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');

    $routes->get('/products', 'Products::index');
    $routes->get('/products/create', 'Products::create');
    $routes->post('/products/store', 'Products::store');
    $routes->get('/products/edit/(:num)', 'Products::edit/$1');
    $routes->post('/products/update/(:num)', 'Products::update/$1');
    $routes->get('/products/delete/(:num)', 'Products::delete/$1');

    $routes->get('variants/index/(:num)', 'Variants::index/$1');
    $routes->get('variants/create/(:num)', 'Variants::create/$1');
    $routes->post('variants/store', 'Variants::store');
    $routes->get('variants/delete/(:num)/(:num)', 'Variants::delete/$1/$2');
    $routes->get('variants/(:num)', 'Variants::index/$1');
    $routes->get('variants/edit/(:num)', 'Variants::edit/$1');
    $routes->post('variants/update', 'Variants::update');

    $routes->get('/sales', 'Sales::index');
    $routes->post('/sales/checkout', 'Sales::checkout');

    $routes->get('/returns', 'Returns::index');
    $routes->post('/returns/store', 'Returns::store');

    // Superadmin-only routes
    $routes->group('', ['filter' => 'role:superadmin'], function ($routes) {
        $routes->get('/users', 'Users::index');
        $routes->get('/users/create', 'Users::create');
        $routes->post('/users/store', 'Users::store');
        $routes->get('/users/edit/(:num)', 'Users::edit/$1');
        $routes->post('/users/update/(:num)', 'Users::update/$1');
        $routes->get('/users/delete/(:num)', 'Users::delete/$1');
    });
});

// API routes — token auth only, no session required
$routes->get('/api/products', 'Api::products');
$routes->get('/api/products/(:num)', 'Api::product/$1');
$routes->get('/api/stock/(:num)', 'Api::stock/$1');