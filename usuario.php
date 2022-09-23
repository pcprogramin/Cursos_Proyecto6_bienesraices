<?php
ini_set('display_errors', 1);
require 'includes/config/app.php';
$db = conectarDB();


$email = "correo@correo.com";

$password = "123456";

$password_hash=password_hash($password,PASSWORD_DEFAULT);


$query = "INSERT INTO usuario (email,password) VALUES ('${email}','${password_hash}')";

mysqli_query($db,$query);