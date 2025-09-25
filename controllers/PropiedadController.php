<?php

namespace Controllers;

USE MVC\Router;
USE Model\Propiedad;
USE Model\Vendedor;
USE Model\Blog;
USE Intervention\Image\Drivers\Gd\Driver;
USE Intervention\Image\ImageManager as Image;

class PropiedadController {

    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $propiedad = Propiedad::all();
        $blog = Blog::all();

         // Muestra mensaje condicional
   

        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades, 
            'vendedores' => $vendedores,
            'resultado' => $resultado,
            'propiedad' => $propiedad,
            'blog' => $blog
        ]);
    }

    public static function crear(Router $router) {
        
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            /** SUBIDA DE IMAGEN */
             // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen']) -> cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar que no haya campos vacíos
            $errores = $propiedad->validar();

            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda la imagen en el servidor
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        // Consultar para obtener los vendedores
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);;

            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen']) -> cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            // Validación
            $errores = $propiedad->validar();

            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // debuguear($_POST);
            //validar id
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            
            }
        }
    }
}

