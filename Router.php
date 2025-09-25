<?php 

NAMESPACE MVC;

class Router{
    
    public $rutasGET = [];
    public $rutasPOST = [];

    //Método para registrar una ruta GET
    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    //Método para registrar una ruta POST
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    //Método que verifica la ruta actual y ejecuta la función correspondiente
    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //areglos de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){

            if(!$auth){
                header('Location: /');
            }
        }

        // Si existe una función asociada, la ejecuta
        if($fn){
            // La URL existe y hay una función asociada
            call_user_func($fn, $this);
        }else{
            header("HTTP/1.0 404 Not Found", true, 404); 
            // echo "Página no encontrada";
        }
    }   

    //Muestra una vista
    //Método para renderizar una vista con datos
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value; //Variable variable
        }
        
        ob_start(); //Almacena en memoria lo que se imprime
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }
}