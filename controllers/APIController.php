<?php

namespace Controllers;

use Model\Cita;
use Model\CitaReservada;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function getAppointments() {
        $citas = CitaReservada::all();
        echo json_encode($citas);
    }

    public static function save() {
        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //Almacena la cita y los servicios
        $idServicios = explode(',', $_POST['servicios']);

        foreach ($idServicios as $idServicio) {
            $args = [
                'citaID' => $id,
                'servicioID' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function delete() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}