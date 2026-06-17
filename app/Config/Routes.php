<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->post('/auth/authentifier', 'AuthController::authentifier');

$routes->get('/caisse', 'CaisseController::index');
$routes->post('/caisse/valider', 'CaisseController::validerCaisse');

$routes->get('/achats', 'AchatController::index');
$routes->post('/achats/ajouter', 'AchatController::ajouter');
$routes->post('/achats/cloturer', 'AchatController::cloturer');