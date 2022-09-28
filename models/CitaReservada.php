<?php

namespace Model;

class CitaReservada extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['fecha', 'hora'];

    public $fecha;
    public $hora;

    public function __construct($args = []) {
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
    }

}