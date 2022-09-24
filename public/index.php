<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\ServicioController;

$router = new Router();

//Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar password
$router->get('/reset', [LoginController::class, 'reset']);
$router->post('/reset', [LoginController::class, 'reset']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

//Crear cuenta
$router->get('/new-account', [LoginController::class, 'create']);
$router->post('/new-account', [LoginController::class, 'create']);

//Confirmar cuenta
$router->get('/confirm-account', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);

//Area privada
$router->get('/appointment', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API de citas
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/appointment', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

//CRUD de servicios
$router->get('/services', [ServicioController::class, 'index']);
$router->get('/services/create', [ServicioController::class, 'create']);
$router->post('/services/create', [ServicioController::class, 'create']);
$router->get('/services/update', [ServicioController::class, 'update']);
$router->post('/services/update', [ServicioController::class, 'update']);
$router->post('/services/delete', [ServicioController::class, 'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();