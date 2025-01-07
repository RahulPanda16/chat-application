<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->setDefaultController("Users");

$routes->get('/login', 'Users::index');
$routes->post('/login', 'Users::index');
$routes->match(['get','post'],'/signup', 'Users::register');
$routes->post('/signup2', 'Users::register');
$routes->get('/logout', 'Users::logout');

$routes->get('/', 'Home::index');
$routes->get('/chat', 'Home::chat');
$routes->get('/users', 'Home::table');
$routes->get('/access', 'Home::access');
$routes->match(['get','post'],'/campaign', 'Home::campaign');
// $routes->get('/access', 'Home::access');

$routes->post('/saveUser','Home::saveUser');
$routes->match(['get','post'],'/getSingleUser/(:num)','Home::getSingleUser/$1');
$routes->post('/updateUser','Home::updateUser');
$routes->post('/deleteUser','Home::deleteUser');

$routes->post('/saveCampaign','Home::saveCampaign');
$routes->get('/getSingleCampaign/(:num)','Home::getSingleCampaign/$1');
$routes->post('/updateCampaign','Home::updateCampaign');
$routes->post('/deleteCampaign','Home::deleteCampaign');

$routes->post('/addRole','Home::addRole');
$routes->get('/getSingleRole/(:num)','Home::getSingleRole/$1');
$routes->post('/updateRole','Home::updateRole');
$routes->post('/deleteRole','Home::deleteRole');