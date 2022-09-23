<?php

function conectarDB() : mysqli {
    $db = new mysqli ('localhost','root','Naruto_1998','bienes_raices');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}