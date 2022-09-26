<?php
    namespace App;

    class Propiedad{

        protected static $db;
        protected static $columnasDB=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];

        protected static $errores = []; 

        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedorId;
        public static function setDB ($database){
            self::$db=$database;
        }
        public function __construct($args =[]){
            $this->id = $args["id"] ?? '';
            $this->precio = $args["precio"] ?? '';
            $this->titulo = $args["titulo"] ?? '';
            $this->imagen = $args["imagen"] ?? '';
            $this->descripcion = $args["descripcion"] ?? '';
            $this->habitaciones = $args["habitaciones"] ?? '';
            $this->wc = $args["wc"] ?? '';
            $this->estacionamiento = $args["estacionamiento"] ?? '';
            $this->creado = date ('Y/m/d');
            $this->vendedorId = $args["vendedorId"] ?? '';
        }

        public function guardar () {

            $atributos = $this->sanitizarAtributos();
            $query = " INSERT INTO propiedades (";
            $query .= join(',',array_keys($atributos));
            $query .= " ) VALUES (' ";
            $query .= join("','",array_values($atributos));
            $query .= " ')";
            $resultado = self::$db->query($query);
            
            return $resultado;
        }
       // Identificar y unir los atributos de la DB
        public function atributos(){
            $atributos = [];
            foreach(self::$columnasDB as $columna){
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            } 
            return $atributos;
        }

        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado [$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }

        public function setImagen ($imagen){
            if($imagen){
                $this->imagen=$imagen;
            }
        }

        public static function getErrores(){

            return self::$errores;
        }
        public function validar (){
            if(!$this->titulo){
                self::$errores [] ="Debes añadir un titulo";
            }
    
            if(!$this->precio){
                self::$errores [] ="Debes añadir un precio";
            }
    
            if(strlen($this->descripcion) < 50){
                self::$errores [] ="La descripcion es obligatoria y tiene que tener 50 caracteres";
            }
    
            if(!$this->habitaciones){
                self::$errores [] ="Debes añadir las habitaciones";
            }
    
            if(!$this->wc){
                self::$errores [] ="Debes añadir los baños";
            }
    
            if(!$this->estacionamiento){
                self::$errores [] ="Debes añadir los estacionamiento";
            }
            if (empty($this->vendedorId)){
                self::$errores [] ="Debes seleccionar un vendedor";
            }
            if(!$this->imagen){
                self::$errores[] = "Debes introducir una imagen";
            }
    
            return self::$errores;
        }
    }