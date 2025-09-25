<?php  

namespace Model;

/**
 * Clase ActiveRecord
 * 
 * Esta clase implementa un modelo genérico para interactuar con la base de datos
 * siguiendo el patrón Active Record.
 * 
 * @property int $id
 * @property string $imagen
 */
class ActiveRecord {
    /* ===============================
       ATRIBUTOS ESTÁTICOS (compartidos)
    ================================ */

    // Conexión a la base de datos
    protected static $db;

    // Columnas de la tabla en la BD
    protected static $columansDB = [];

    // Nombre de la tabla asociada
    protected static $tabla = '';

    // Manejo de errores de validación
    protected static $errores = [];


    /* ===============================
       MÉTODOS DE CONFIGURACIÓN
    ================================ */

    /**
     * Asigna la conexión de la BD a la clase
     */
    public static function setDB($database) {
        // self hace referencia a atributos estáticos de esta clase
        self::$db = $database;
    }


    /* ===============================
       MÉTODOS CRUD (Create, Read, Update, Delete)
    ================================ */

    /**
     * Guarda el registro actual
     * - Si existe ID → Actualiza
     * - Si no → Crea
     */
    public function guardar() {
        if(!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    /**
     * Crea un nuevo registro en la BD
     */
    public function crear() {
        $atributos = $this->sanitizarAtributos();

        // Construcción de la consulta SQL
        $query  = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos)) . ") ";
        $query .= "VALUE ('" . join("', '", array_values($atributos)) . "')";
   
        $resultado = self::$db->query($query);

        if($resultado) {
            // Redirigir al usuario tras crear
            header('Location: /admin?resultado=1');
        }
    }

    /**
     * Actualiza un registro existente en la BD
     */
    public function actualizar() {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query  = "UPDATE ". static::$tabla . " SET ";
        $query .= join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    /**
     * Elimina el registro actual de la BD
     */
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . 
                 " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
            exit;
        }
    }


    /* ===============================
       MÉTODOS DE ATRIBUTOS Y VALIDACIÓN
    ================================ */

    /**
     * Devuelve los atributos del objeto en un array
     */
    public function atributos() {
        $atributos = [];
        foreach(static::$columansDB as $columna) {
            if($columna === 'id') continue; // No incluir ID
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    /**
     * Sanitiza los valores para prevenir inyección SQL
     */
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    /**
     * Obtiene errores de validación
     */
    public static function getErrores() {
        return static::$errores;
    }

    /**
     * Valida los atributos (debe implementarse en hijos)
     */
    public function validar() {
        static::$errores = [];
        return static::$errores;
    }


    /* ===============================
       MÉTODOS PARA MANEJO DE IMÁGENES
    ================================ */

    /**
     * Asigna una imagen al objeto y elimina la previa si existe
     */
    public function setImagen($imagen) {
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    /**
     * Elimina la imagen asociada al objeto en el servidor
     */
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }


    /* ===============================
       MÉTODOS DE CONSULTA
    ================================ */

    /**
     * Obtiene todos los registros de la tabla
     */
    public static function all() {
        $query = "SELECT * FROM ". static::$tabla; 
        return self::consultarAQL($query);
    }

    /**
     * Obtiene registros con un límite
     */
    public static function get($cantidad) {
        $query = "SELECT * FROM ". static::$tabla . " LIMIT " . $cantidad; 
        return self::consultarAQL($query);
    }

    /**
     * Busca un registro por su ID
     */
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarAQL($query);
        return array_shift($resultado); // Devuelve el primer resultado
    }

    /**
     * Ejecuta una consulta SQL y devuelve objetos
     */
    public static function consultarAQL($query) {
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free(); // Liberar memoria
        return $array;
    }

    /**
     * Crea un objeto a partir de un registro de BD
     */
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }


    /* ===============================
       MÉTODO DE SINCRONIZACIÓN
    ================================ */

    /**
     * Sincroniza los datos del objeto en memoria con un array
     */
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
