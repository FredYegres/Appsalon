<?php 

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index(Router $router) {
        isAuth();
        isAdmin();

        $servicios = Servicio::all();

        $router->render('services/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function create(Router $router) {
        isAuth();
        isAdmin();
        $servicio = new Servicio;
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /services');
            }
        }

        $router->render('services/create', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
        ]);
    }

    public static function update(Router $router) {
        isAuth();
        isAdmin();
        $alertas = [];

        if(!is_numeric($_GET['id'])) {
            header('Location: /services');
        }
        $servicio = Servicio::find($_GET['id']);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /services');
            }
        }

        $router->render('services/update', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio
        ]);
    }

    public static function delete() {
        isAuth();
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();

            header('Location: /services');
        }
    }
}