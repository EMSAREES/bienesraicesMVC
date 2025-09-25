<?php
namespace Controllers;

USE MVC\Router;
USE Model\Propiedad;
USE Model\Vendedor;
USE Intervention\Image\Drivers\Gd\Driver;
USE Intervention\Image\ImageManager as Image;


class VendedorController {

    public static function crear(Router $router) {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar que no haya campos vacíos
            $errores = $vendedor->validar();

            if(empty($errores)) {
                // Guarda la imagen en el servidor
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        //obtener los datos del vendedor
        $vendedor = Vendedor::find($id);

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();

            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}