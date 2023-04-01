<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo actualizar_interfaz.php -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/output.css">
    <!-- Script necesario para las alertas de sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php
// Se llama a la conexion
require("../conexion.php");

// Proceso de PHP para actualizar registros de la tabla interfaz_red
// Aquí se obtiene el dato enviado por el url desde el archivo actualizar_interfaz.php
$url = $_GET["url"];

// $actualizarni = $_POST['actualizarni'];
$actualizarssid = $_POST['actualizarssid'];
$actualizarip = $_POST['actualizarip'];
$actualizarmac = $_POST['actualizarmac'];
// $actualizaridrecurso = $_POST['actualizaridrecurso'];
$actualizartc = $_POST['actualizartc'];

$actualizardatos = "UPDATE interfaz_red SET SSID='$actualizarssid', IP='$actualizarip', MAC='$actualizarmac', Tipo_conectividad_id='$actualizartc' WHERE idInterfaz_red = '$url'";

// Alertas de sweetalert2
if ($conexion->query($actualizardatos) === true) {
    echo '<script>
    swal.fire({
        title: "Éxito!",
        text: "Se actualizó la interfaz",
        icon: "success",
        showConfirmButton: false,
        timer: 2600
      });
    function saludos(){
        window.history.go(-3);
            }
    setTimeout(saludos, 2600);
        </script>';
    die();
} else {
    echo '<script>
    swal.fire({
        title: "Error!",
        text: "No se actualizó la interfaz!",
        icon: "error",
        showConfirmButton: false,
        timer: 2600
      });
    function saludos(){
        window.history.go(-3);
            }
    setTimeout(saludos, 2600);
        </script>';
}
?>
</body>

</html>