<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
use App\Controllers\Pages;
use App\Controllers\Games;

$routes->get('games/', [Games::class, 'index']);   
$routes->get('games/new', [Games::class, 'new']);
$routes->post('games/', [Games::class, 'create']);      
$routes->get('games/(:segment)', [Games::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);