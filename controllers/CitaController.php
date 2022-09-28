<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index(Router $router) {
        isAuth();

        $router->render('appointment/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
        ]);
    }
}