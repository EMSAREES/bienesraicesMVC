<?php

// require 'app.php';

//SUPER GLOBALES
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUCTION_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = False){
    include TEMPLATES_URL . "/{$nombre}.php";
}



function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }

}

//para hacer pruebas  y ver si llegan balores lo que entiendo yo
function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

//Escapa / Sanitizar el HTML
function s($html): string {
    $s = htmlspecialchars($html);
    return $s;
}

//vlidar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad', 'blog'];

    return in_array($tipo, $tipos);
}

//muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';
    $color = '';

    switch($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            $color = 'success';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            $color = 'success-actualizado';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            $color = 'success-delecte';
            break;
        default:
            $mensaje = false;
            break;
    }

    return [$mensaje, $color];
}

//validar id
function validarORedireccionar(string $url) {
      // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: $url");
    }

    return $id;
}