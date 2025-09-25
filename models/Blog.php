<?php
namespace Model;

class Blog extends ActiveRecord{
    protected static $tabla = 'blogs';
    protected static $columansDB = ['id', 'titulo', 'imagen', 'descripcion', 'creado', 'usuarioId' ];
    
    public $id;
    public $titulo;
    public $imagen;
    public $descripcion;
    public $creado;
    public $usuarioId;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creado = date('Y/m/d');
        $this->usuarioId = $args['usuarioId'] ?? '';
        
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(strlen($this->descripcion) < 50 ) {
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->usuarioId) {
            self::$errores[] = "Elige un vendedor";
        }
        
        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

}