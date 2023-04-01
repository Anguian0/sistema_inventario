<!-- Este archivo es parte de la función de select del input "Selecciona un espacio" del archivo añadir_recurso.php, lo que hace es devolver los espacios que hay dependiendo el área seleccionada por el usuario en el select anterior a este. -->

<?php
// Se llama a la conexion
require("../conexion.php");

// CSS con PHP
define('CSSPATH', '../css');
$cssItem = 'output.css';

// Proceso de PHP para mostrar datos de las tablas Areas y Espacios
$nombrearea = $_POST['NombreArea'];

$sql = mysqli_query($conexion, "SELECT t1.idArea, t1.NombreArea, t2.idEspacio, t2.NombreEspacio, t2.Area_id, t2.Tipo_espacio_id FROM areas t1 INNER JOIN espacios t2 ON t1.idArea = t2.Area_id WHERE idArea = $nombrearea");

// Devuelve los espacios
$cadena = "<label class='block mb-2 text-sm font-medium text-gray-900'>
Selecciona el espacio</label>
<select type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5' id='añadirespacio' name='añadirespacio' required='required'>
<option hidden selected disable>Selecciona un espacio</option>";

while ($ver = mysqli_fetch_row($sql)) {
    $cadena = $cadena. '<option value='.$ver[2].'>'.utf8_encode($ver[3]).'</option>';
}

echo $cadena."</select>";

?>