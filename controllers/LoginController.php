<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        sesionIniciada();

        $alertas = [];
        $auth = new Usuario();
        $usuarioInvalido = false;
        $passwordInvalida = false;
        $noConfirmado = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                //Comprobar que exista usuario
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    //Verificar Password
                    $resultado = $usuario->comprobarPassword($auth->password);

                    if(!$resultado) {
                        $passwordInvalida = true;
                        
                    } else if(!$usuario->confirmado) {
                        $noConfirmado = true;

                    } else {
                        //Autenticar usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        //Redireccionamiento
                        if($usuario->admin) {
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        } else {
                            header('Location: /appointment');
                        } 
                    }

                } else {
                    $usuarioInvalido = true;

                }
            }
        }

        $router->render('auth/login', [
            'auth' => $auth,
            'usuarioInvalido' => $usuarioInvalido,
            'passwordInvalida' => $passwordInvalida,
            'noConfirmado' => $noConfirmado
        ]);
    }

    public static function logout() {
        $_SESSION = [];

        header('Location: /');
    }

    public static function reset(Router $router) {
        sesionIniciada();

        $alertas = [];
        $auth = new Usuario();
        $usuarioInvalido = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

        if(empty($alertas)) {
            $usuario = Usuario::where('email', $auth->email);

            if($usuario && $usuario->confirmado) {
                
                //Generar token
                $usuario->crearToken();
                $usuario->guardar();

                //Enviar email
                $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                $email->enviarInstrucciones();

                //Alerta de exito
                Usuario::setAlerta('exito', 'email', 'Revisa tu e-mail');

            } else {
                Usuario::setAlerta('error', 'email', 'Usuario Invalido');
                $usuarioInvalido = true;
            }
        }
        }
        $router->render('auth/reset-password', [
            'auth' => $auth,
            'usuarioInvalido' => $usuarioInvalido
        ]);
    }

    public static function recover(Router $router) {
        sesionIniciada();
        if(!$_GET['token']) {
            header('Location: /');
        }

        $alertas = [];
        $token = s($_GET['token']);
        $error = false;
        $auth = new Usuario();
        
        //Buscar usuario por su token
        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'token', 'Token no valido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer el nuevo password y guardarlo
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado) {
                    header('Location: /');
                }
            }
        }



        $router->render('auth/recover-password', [
            'usuario' => $usuario,
            'error' => $error,
            'auth' => $auth
        ]);
    }
   
    public static function create(Router $router) {
        sesionIniciada();

        $usuario = new Usuario;
        $alertas = [];
        $usuarioExiste = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if(empty($alertas)) {
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $usuarioExiste = true;
                } else {
                    //Hashear password
                    $usuario->hashPassword();
                    
                    //Generar un token unico
                    $usuario->crearToken();

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /message');
                    }

                }
            }

        }

        $router->render('auth/new-account', [
            'usuario' => $usuario,
            'usuarioExiste' => $usuarioExiste

        ]);
    }

    public static function message(Router $router) {
        sesionIniciada();

        $router->render('auth/message');
    }

    public static function confirm(Router $router) {
        sesionIniciada();
        if(!$_GET['token']) {
            header('Location: /');
        }
        
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(!empty($usuario)) {
            //Modificar usuario
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            
        }


        $router->render('auth/confirm-account' , [
            'usuario' => $usuario
        ]);
    }
}