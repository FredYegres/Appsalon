<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        //Crear objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'fc5e9543bcd32a';
        $mail->Password = '87ca33a4b3e869';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, confirmala entrando al siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='https://appsalon-mvc.herokuapp.com/confirm-account?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste este email, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones() {
         //Crear objeto de email
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = 'smtp.mailtrap.io';
         $mail->SMTPAuth = true;
         $mail->Port = 2525;
         $mail->Username = 'fc5e9543bcd32a';
         $mail->Password = '87ca33a4b3e869';
 
         $mail->setFrom('cuentas@appsalon.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Reestablece tu Contraseña';
 
         //Set HTML
         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8'; 
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu contraseña, para hacerlo entra al siguiente enlace:</p>";
         $contenido .= "<p>Presiona aquí: <a href='https://appsalon-mvc.herokuapp.com/recover?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";
         $contenido .= "<p>Si no solicitaste este email, puedes ignorar el mensaje</p>";
         $contenido .= "</html>";
 
         $mail->Body = $contenido;
 
         //Enviar el email
         $mail->send();
    }
}