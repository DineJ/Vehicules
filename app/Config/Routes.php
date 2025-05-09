<?php

use CodeIgniter\Router\RouteCollection;
// Auto-generated routes

// Routes pour Permis
$routes->get('Permis', 'PermisController::index');
$routes->get('Permis/show/(:num)', 'PermisController::show/$1');
$routes->get('Permis/create/(:num)', 'PermisController::create/$1');
$routes->post('Permis/store/', 'PermisController::store');
$routes->get('Permis/edit/(:num)', 'PermisController::edit/$1');
$routes->post('Permis/update/(:num)', 'PermisController::update/$1');
$routes->get('Permis/delete/(:num)', 'PermisController::delete/$1');


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
