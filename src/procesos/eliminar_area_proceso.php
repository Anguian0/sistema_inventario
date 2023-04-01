<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo eliminar_area.php -->

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
    include("../conexion.php");

    // Proceso de PHP para eliminar registros de la tabla areas
    $eliminararea = $_POST["eliminararea"];
    $eliminardatos = "DELETE FROM areas WHERE NombreArea = '$eliminararea'";

    $resultado = mysqli_query($conexion, $eliminardatos);
    // Alertas de sweetalert2
    if ($resultado) {
        echo '<script>
        swal.fire({
            title: "Éxito!",
            text: "Se eliminó el área",
            icon: "success",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-1);
                }
        setTimeout(saludos, 2600);
       
    </script>';
        die();
    } else {
        echo '<script>
        swal.fire({
            title: "Error!",
            text: "No se eliminó el área",
            icon: "error",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-1);
                }
        setTimeout(saludos, 2600);
       
    </script>';
    }
    ?>
</body>

</html>