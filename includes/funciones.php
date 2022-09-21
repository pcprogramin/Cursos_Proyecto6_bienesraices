<?php
    define('TEMPLATES_URL',__DIR__.'\templates\\');
    define('FUNCIONES_URL','funciones.php');
    function incluirTemplates( string $nombre , bool $inicio = false ){
        include TEMPLATES_URL."${nombre}.php";
    }
    function estarAutenticado ():bool {
        session_start();
        $auth = $_SESSION['login'];
        if ($auth) {
           return true;
        }
        return false;
    }