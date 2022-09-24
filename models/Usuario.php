<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];
    public $id = 'id';
    public $nombre = 'nombre';
    public $apellido = 'apellido';
    public $email = 'email';
    public $password = 'password';
    public $telefono = 'telefono';
    public $admin = 'admin';
    public $confirmado = 'confirmado';
    public $token = 'token';

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    //Mensaje de validacion para crear cuenta
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error']['nombre'] = 'El nombre es obligatorio';
        }

        if (!$this->apellido) {
            self::$alertas['error']['apellido'] = 'El apellido es obligatorio';
        }

        if (!$this->email) {
            self::$alertas['error']['email'] = 'El email es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error']['password'] = 'La contraseña es obligatoria';
        } else if (strlen($this->password) < 8) {
            self::$alertas['error']['password'] = 'La contraseña debe ser mayor a 8 caracteres';
        }

        if (!$this->telefono) {
            self::$alertas['error']['telefono'] = 'El teléfono es obligatorio';
        }

        return self::$alertas;
    }

    public function validarLogin() {
        
        if (!$this->email) {
            self::$alertas['error']['email'] = 'El email es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error']['password'] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error']['email'] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error']['password'] = 'La contraseña es obligatoria';
        } else if (strlen($this->password) < 8) {
            self::$alertas['error']['password'] = 'La contraseña debe ser mayor a 8 caracteres';
        }
        return self::$alertas;
    }

    //Revisa si el usuario existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function mostrarAlertas($nombre, $password = false, $usuarioInvalido = false) {
        
        if(!empty(static::$alertas['error'])) {
            if (($password && strlen($this->password) < 8) || (!$this->$nombre && !$password && !$usuarioInvalido) || $usuarioInvalido) {
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

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPassword($password) {
        $resultado = password_verify($password, $this->password);
        
        return $resultado;
    }
}