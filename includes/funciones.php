<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo) : bool {
    if($actual !== $proximo) {
        return true;
    }
    return false;
}

//Revisar que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

//Revisar que el usuario sea admin
function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}

//Si la sesion ya esta iniciada redirige
function sesionIniciada() {
    if(isset($_SESSION['login'])) {
        if(isset($_SESSION['admin'])) {
            header('Location: /admin');
        } else {
            header('Location: /appointment');
        }
    }
}