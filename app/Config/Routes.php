<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth::login', ['filter' => 'guest']);
    $routes->get('register', 'Auth::registerView', ['filter' => 'guest']);
    $routes->post('do-login', 'Auth::doLogin', ['filter' => 'guest']);
    $routes->post('do-register', 'Auth::doRegister', ['filter' => 'guest']);
    $routes->get('logout', 'Auth::logout', ['filter' => 'auth']);
});

// Dashboard Routes
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->post('note/create', 'Dashboard::create', ['filter' => 'auth']);
$routes->get('note/edit/(:num)', 'Dashboard::edit/$1', ['filter' => 'auth']);
$routes->post('note/update/(:num)', 'Dashboard::update/$1', ['filter' => 'auth']);
$routes->get('note/toggle-pin/(:num)', 'Dashboard::togglePin/$1', ['filter' => 'auth']);
$routes->get('note/delete/(:num)', 'Dashboard::delete/$1', ['filter' => 'auth']);

$routes->get('/', 'Auth::login', ['filter' => 'guest']);
