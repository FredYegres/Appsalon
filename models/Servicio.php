<?php

namespace Model;

class Servicio extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error']['nombre'] = 'El nombre del servicio es obligatorio';
        }
        if(!$this->precio) {
            self::$alertas['error']['precio'] = 'El precio del servicio es obligatorio';
        } else if(!is_numeric($this->precio)) {
            self::$alertas['error']['precio'] = 'El precio no es valido';
        }

        return self::$alertas;
    }

    public function mostrarAlertas($nombre, $precio = false) {
        
        if(!empty(static::$alertas['error'])) {
            if (($precio && !is_numeric($this->precio)) || !$this->$nombre) {
                echo '<div class="alerta error">';
                echo static::$alertas['error'][$nombre];
                echo '</div>';
            } 
            
        } else if(!empty(static::$alertas['exito'])) {
            if (!empty($nombre)) {
                echo '<div class="alerta exito">';
                echo static::$alertas['exito'][$nombre];
                echo '</div>';
            }  
        }
    }
}