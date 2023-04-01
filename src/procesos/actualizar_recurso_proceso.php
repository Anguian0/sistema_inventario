<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo actualizar_recurso.php -->

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


// Proceso de PHP para actualizar registros de la tabla recursos
// Aquí se obtiene el dato enviado por el url desde el archivo actualizar_recurso.php
$url = $_GET["url"];

$actualizarmarca = $_POST['actualizarmarca'];
$actualizarmodelo = $_POST['actualizarmodelo'];
$actualizarnumeroserie = $_POST['actualizarnumeroserie'];
$actualizardescripcion = $_POST['actualizardescripcion'];
$actualizarobservaciones = $_POST['actualizarobservaciones'];
$actualizarpuertos = $_POST['actualizarpuertos'];
$actualizarrfc = $_POST['actualizarrfc'];
$actualizarconectadoa = $_POST['actualizarconectadoa'];
$actualizarpuertoorigen = $_POST['actualizarpuertoorigen'];
$actualizarpuertodestino = $_POST['actualizarpuertodestino'];
$actualizartipo = $_POST['actualizartipo'];

$actualizardatos = "UPDATE recursos SET Marca='$actualizarmarca', Modelo='$actualizarmodelo', Numero_serie='$actualizarnumeroserie', Descripcion='$actualizardescripcion', Observaciones='$actualizarobservaciones', Puertos='$actualizarpuertos', RFC='$actualizarrfc', Conectado_a='$actualizarconectadoa', Puerto_origen='$actualizarpuertoorigen', Puerto_destino='$actualizarpuertodestino', Tipo_equipo_id='$actualizartipo' WHERE idRecurso = '$url'";

// Alertas de sweetalert2
if ($conexion->query($actualizardatos) === true) {
    echo '<script>
        swal.fire({
            title: "Éxito!",
            text: "Se actualizó el equipo",
            icon: "success",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-3);
                }
        setTimeout(saludos, 2600);
       
    </script>';
    } else {
        echo '<script>
        swal.fire({
            title: "Error!",
            text: "No se actualizó el equipo",
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