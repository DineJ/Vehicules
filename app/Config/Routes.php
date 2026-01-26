<?php

use CodeIgniter\Router\RouteCollection;
// Auto-generated routes

$routes->group('', ['filter' => 'Redirection:admin'], function($routes)
{

// Routes for Infraction
$routes->get('Infraction', 'InfractionController::index');
$routes->get('Infraction/show/(:num)', 'InfractionController::show/$1');
$routes->match(['post', 'get'], 'Infraction/create', 'InfractionController::create');
$routes->post('Infraction/store', 'InfractionController::store');
$routes->get('Infraction/edit/(:num)', 'InfractionController::edit/$1');
$routes->post('Infraction/update/(:num)', 'InfractionController::update/$1');
$routes->get('Infraction/delete/(:num)', 'InfractionController::delete/$1');


// Routes for Lieu
$routes->get('Lieu', 'LieuController::index');
$routes->get('Lieu/show/(:num)', 'LieuController::show/$1');
$routes->get('Lieu/create', 'LieuController::create');
$routes->post('Lieu/store', 'LieuController::store');
$routes->get('Lieu/edit/(:num)', 'LieuController::edit/$1');
$routes->post('Lieu/update/(:num)', 'LieuController::update/$1');
$routes->get('Lieu/delete/(:num)', 'LieuController::delete/$1');


// Routes for Mission

$routes->get('Mission', 'MissionController::index');
$routes->get('Mission/show/(:num)', 'MissionController::show/$1');
$routes->get('Mission/create', 'MissionController::create');
$routes->post('Mission/store', 'MissionController::store');
$routes->get('Mission/edit/(:num)', 'MissionController::edit/$1');
$routes->post('Mission/update/(:num)', 'MissionController::update/$1');
$routes->get('Mission/delete/(:num)', 'MissionController::delete/$1');



// Routes for Assurance
$routes->get('Assurance', 'AssuranceController::index');
$routes->get('Assurance/show/(:num)', 'AssuranceController::show/$1');
$routes->match(['post', 'get'],'Assurance/create', 'AssuranceController::create');
$routes->post('Assurance/store', 'AssuranceController::store');
$routes->get('Assurance/edit/(:num)', 'AssuranceController::edit/$1');
$routes->post('Assurance/update/(:num)', 'AssuranceController::update/$1');
$routes->get('Assurance/delete/(:num)', 'AssuranceController::delete/$1');


// Routes for Suivi
$routes->get('Suivi', 'SuiviController::index'); // Route that leads to the display of all data
$routes->get('Suivi/show/(:num)', 'SuiviController::show/$1'); // Route that leads to the display of one specific data
$routes->match(['post', 'get'], 'Suivi/create', 'SuiviController::create'); // Route that leads to the display of creating a specific data
$routes->post('Suivi/store', 'SuiviController::store'); // Route that leads to the insert fuction of the DB
$routes->get('Suivi/edit/(:num)', 'SuiviController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('Suivi/update/(:num)', 'SuiviController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('Suivi/delete/(:num)', 'SuiviController::delete/$1'); // Not used


// Routes for Ip
$routes->get('Ip', 'IpController::index');  // Route that leads to the display of all data
$routes->post('Ip/update/(:num)', 'IpController::update/$1'); // Route that leads to the update fuction of the DB


// Routes for Type_incident
$routes->get('Type_incident', 'Type_incidentController::index'); // Route that leads to the display of all data
$routes->get('Type_incident/show/(:num)', 'Type_incidentController::show/$1'); // Route that leads to the display of one specific data
$routes->match(['post', 'get'], 'Type_incident/create', 'Type_incidentController::create'); // Route that leads to the display of creating a specific data
$routes->post('Type_incident/store', 'Type_incidentController::store'); // Route that leads to the insert fuction of the DB
$routes->get('Type_incident/edit/(:num)', 'Type_incidentController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('Type_incident/update/(:num)', 'Type_incidentController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('Type_incident/delete/(:num)', 'Type_incidentController::delete/$1'); 


// Routes for Vehicule
$routes->get('Vehicule', 'VehiculeController::index'); // Route that leads to the display of all data
$routes->get('Vehicule/show/(:num)', 'VehiculeController::show/$1'); // Route that leads to the display of one specific data
$routes->get('Vehicule/create', 'VehiculeController::create'); // Route that leads to the display of creating a specific data
$routes->post('Vehicule/store', 'VehiculeController::store'); // Route that leads to the insert fuction of the DB
$routes->get('Vehicule/edit/(:num)', 'VehiculeController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('Vehicule/update/(:num)', 'VehiculeController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('Vehicule/delete/(:num)', 'VehiculeController::delete/$1'); // Not used


// Routes for Incident
$routes->get('Incident', 'IncidentController::index'); // Route that leads to the display of all data
$routes->get('Incident/show/(:num)', 'IncidentController::show/$1'); // Route that leads to the display of one specific data
$routes->get('Incident/create', 'IncidentController::create'); // Route that leads to the display of creating a specific data
$routes->post('Incident/store', 'IncidentController::store'); // Route that leads to the insert fuction of the DB
$routes->get('Incident/edit/(:num)', 'IncidentController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('Incident/update/(:num)', 'IncidentController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('Incident/delete/(:num)', 'IncidentController::delete/$1'); // Not used


// Routes for Permis
$routes->get('Permis/create/(:num)', 'PermisController::create/$1'); // Route that leads to the display of creating a specific data
$routes->post('Permis/store/', 'PermisController::store'); // Route that leads to the insert fuction of the DB
$routes->get('Permis/edit/(:num)', 'PermisController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('Permis/update/(:num)', 'PermisController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('Permis/delete/(:num)', 'PermisController::delete/$1'); // Not used


// Routes for User
$routes->get('User', 'UserController::index'); // Route that leads to the display of all data
$routes->get('User/show/(:num)', 'UserController::show/$1'); // Route that leads to the display of one specific data
$routes->get('User/create', 'UserController::create'); // Route that leads to the display of creating a specific data
$routes->post('User/store', 'UserController::store'); // Route that leads to the insert fuction of the DB
$routes->get('User/edit/(:num)', 'UserController::edit/$1'); // Route that leads to the display of editing a specific data
$routes->post('User/update/(:num)', 'UserController::update/$1'); // Route that leads to the update fuction of the DB
$routes->get('User/delete/(:num)', 'UserController::delete/$1'); // Not used

// Routes for Admin
$routes->get('Admin', 'AdminController::administrator'); // Route that leads to admin view

});


$routes->group('', ['filter' => 'Redirection:nonadmin'], function($routes)
{

//Routes for Non Admin
$routes->get('Non_admin', 'AdminController::nonAdmin'); // Route that lead to non admin view

});


// Routes for Login
$routes->get('Login', 'LoginController::login'); // Route that leads to the display of login view
$routes->post('Login/log', 'LoginController::log'); // Route that leads you to connect
$routes->get('Login/logout', 'LoginController::logout'); // Route that leads you to disconnect

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::login'); // Default Route
