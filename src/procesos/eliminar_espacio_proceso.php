<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo eliminar_espacio.php -->

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
    // Llama a la conexion
    include("../conexion.php");


    // Proceso de PHP para eliminar registros de la tabla espacios
    $eliminarespacio = $_POST["eliminarespacio"];
    $eliminardatos = mysqli_query($conexion, "DELETE FROM espacios WHERE idEspacio = '$eliminarespacio'");

    // Alertas de sweetalert2
    if ($eliminardatos) {
        echo '<script>
        swal.fire({
            title: "Éxito!",
            text: "Se eliminó el espacio",
            icon: "success",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-1);
                }
        setTimeout(saludos, 2600);
       
    </script>';
    } else {
        echo '<script>
        swal.fire({
            title: "Error!",
            text: "No se eliminó el espacio",
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