<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('admin', 'Admin\Dashboard::index');
$routes->get('admin/volunteers', 'Admin\Volunteers::index');