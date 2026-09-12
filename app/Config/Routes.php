<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

/*
|--------------------------------------------------------------------------
| Área Administrativa - Somos 1
|--------------------------------------------------------------------------
*/

$routes->get(
    'admin',
    'Admin\Dashboard::index'
);

/*
|--------------------------------------------------------------------------
| Voluntários
|--------------------------------------------------------------------------
*/

// Listagem
$routes->get(
    'admin/volunteers',
    'Admin\Volunteers::index'
);

// Novo voluntário
$routes->get(
    'admin/volunteers/new',
    'Admin\Volunteers::new'
);

// Salvar novo voluntário
$routes->post(
    'admin/volunteers',
    'Admin\Volunteers::create'
);

// Editar voluntário
$routes->get(
    'admin/volunteers/edit',
    'Admin\Volunteers::edit'
);

// Atualizar voluntário
$routes->post(
    'admin/volunteers/(:segment)',
    'Admin\Volunteers::update/$1'
);