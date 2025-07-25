<?php

use CodeIgniter\Router\RouteCollection;
// Auto-generated routes

// Routes pour Incident
$routes->get('Incident', 'IncidentController::index');
$routes->get('Incident/show/(:num)', 'IncidentController::show/$1');
$routes->get('Incident/create', 'IncidentController::create');
$routes->post('Incident/store', 'IncidentController::store');
$routes->get('Incident/edit/(:num)', 'IncidentController::edit/$1');
$routes->post('Incident/update/(:num)', 'IncidentController::update/$1');
$routes->get('Incident/delete/(:num)', 'IncidentController::delete/$1');


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

// Routes pour Login
$routes->get('Login', 'LoginController::login');
$routes->post('Login/log', 'LoginController::log');
$routes->get('Login/logout', 'LoginController::logout');

// Routes pour Admin
$routes->get('Admin', 'AdminController::administrator');

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::login');
