<?php
// Se hace la conexion a la base de datos del sii
$conexion2 = new mysqli("localhost", "root", "", "sii_prueba");
if ($conexion2->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "\n";
