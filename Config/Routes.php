<?php

use CodeIgniter\Router\RouteCollection;
// Auto-generated routes


// Routes pour User
$routes->get('User', 'UserController::index');
$routes->get('User/show/(:num)', 'UserController::show/$1');
$routes->get('User/create', 'UserController::create');
$routes->post('User/store', 'UserController::store');
$routes->get('User/edit/(:num)', 'UserController::edit/$1');
$routes->post('User/update/(:num)', 'UserController::update/$1');
$routes->get('User/delete/(:num)', 'UserController::delete/$1');

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
