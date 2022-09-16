<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost','root','Naruto_1998','bienes_raices');

    if(!$db){
        echo "Error no se pudo conectar";
    }

    return $db;
}