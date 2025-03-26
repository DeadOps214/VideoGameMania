<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
use App\Controllers\Pages;
use App\Controllers\Games;

$routes->get('VideoGameMania/', [Games::class, 'index']);          
$routes->get('VideoGameMania/(:segment)', [Games::class, 'show']);
$routes->get('news/new', [Games::class, 'new']); // Add this line
$routes->post('news', [Games::class, 'create']); // Add this line

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);