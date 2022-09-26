<?php
    define('TEMPLATES_URL',__DIR__.'\templates\\');
    define('FUNCIONES_URL',__DIR__.'funciones.php');
    define('CARPETA_IMAGENES',__DIR__.'/../imagenes/');
  
    

    function incluirTemplates( string $nombre , bool $inicio = false ){
        include TEMPLATES_URL."${nombre}.php";
    }
    function estarAutenticado (){
        session_start();
        
        if ( !$_SESSION['login']) {
            debuger($_SESSION['login']);
            header('Location:/');
        }
    }

    function debuger ($object){
        echo "<pre>";
        var_dump($object);
        echo "</pre>";
        exit;
    }
