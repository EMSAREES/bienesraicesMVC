<?php

namespace Controllers;

USE MVC\Router;
USE Model\Admin;

class LoginController{

    public static function login(Router $router){

        $errores = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {

                    //verificar si el usuaeio o no  (mensaje de error)
                    $errores = Admin::getErrores();

                } else {

                    // Validar si password es correcto
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado){

                        //Autenticar el usuario
                        $auth->autenticar();

                    } else{
                        $errores = Admin::getErrores();
                    }
                    
                }
                
            }
                
        }

        $router->render("auth/login", [
            "errores" => $errores
        ]);

    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header("Location: /");
    }

}