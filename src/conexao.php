<?php
// Este archivo pertenece al proceso de autocompletar en el input "conectado a" del archivo añadir_recurso.php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gri_prueba";
$port = 3306;

try{
    //Conexión con el puerto
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    //Conexión sin el puerto
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

    //echo "Conexión a la base de datos exitosa!";
}  catch(PDOException $err){
    echo "Erro: La conexión a la base de datos no fue exitosa. Error generado " . $err->getMessage();
}