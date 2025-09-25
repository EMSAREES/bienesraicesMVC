<?php 

namespace Model;


class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columansDB = ['id', 'nombre', 'apellido', 'telefono', 'email' ];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';

    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El Nombre es obligatorio";
        }

        if(!$this->apellido) {
            self::$errores[] = "El Apellido es obligatorio"; 
        }

        if(strlen($this->telefono) <  10) {
            self::$errores[] = "La nuemro de telefono es obligatoria y debe tener al menos 10 caracteres";
        } elseif(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "El formato del telefono no es válido";
        }

        if(!$this->email) {
            self::$errores[] = "El email es obligatorio"; 
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "El email no es válido";
        }


        return self::$errores;
    }

}