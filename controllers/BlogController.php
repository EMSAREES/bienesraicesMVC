<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
USE Model\Vendedor;
USE Intervention\Image\Drivers\Gd\Driver;
USE Intervention\Image\ImageManager as Image;

class BlogController{
    public static function crear(Router $router){

        $blog = new Blog();
        $usuarios = Vendedor::all();
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $blog = new Blog($_POST['blog']);

            /** SUBIDA DE IMAGEN */
             // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['blog']['tmp_name']['imagen']) -> cover(800,600);
                $blog->setImagen($nombreImagen);
            }

            // Validar que no haya campos vacíos
            $errores = $blog->validar();

            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $resultado = $blog->guardar();
                if($resultado) {
                    header('Location: /admin?resultado=1');
                }
            }
        }

        $router->render('blogs/crear', [
            'blog' => $blog,
            'usuarios' => $usuarios,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        //obtener los datos de la blog
        $blog = Blog::find($id);

        //consultar para obtener el blog
        $blogs = Blog::all();

        // Consultar para obtener los vendedores
        $usuarios = Vendedor::all();

        //areglo con mensajes de errores
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            $args = $_POST['blog'];

            $blog->sincronizar($args);

            // Validación
            $errores = $blog->validar();

             /** SUBIDA DE IMAGEN */
             // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

             // Setear la imagen
             // Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['blog']['tmp_name']['imagen']) -> cover(800,600);
                $blog->setImagen($nombreImagen);
            }

            if(empty($errores)) {

                if($_FILES['blog']['tmp_name']['imagen']) {
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
    
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $resultado = $blog->guardar();
                if($resultado) {
                    header('Location: /admin?resultado=2');
                }
            }
        }

        $router->render('blogs/actualizar', [
            'blog' => $blog,
            'usuarios' => $usuarios,
            'errores' => $errores,
            'blogs' => $blogs
        ]);

    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)) {
                    $blog = Blog::find($id);
                    $blog->eliminar();
                }
            }
        }
    }

}