<?php
// Se hace la conexion a la base de datos
$conexion = new mysqli("localhost", "root", "", "gri_prueba");
if ($conexion->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "\n";
