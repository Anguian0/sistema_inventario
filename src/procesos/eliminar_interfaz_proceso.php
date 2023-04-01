<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo acciones_interfaz.php -->

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

    // Proceso de PHP para eliminar registros de la tabla interfaz_red
    // Aquí se obtiene el dato enviado por el url desde el archivo acciones_interfaz.php
    $url = $_GET["url"];
    $eliminardatos = "DELETE FROM interfaz_red WHERE idInterfaz_red = '$url'";


    $resultado = mysqli_query($conexion, $eliminardatos);
    // Alertas de sweetalert2
    if ($resultado) {
        echo '<script>
        swal.fire({
            title: "Éxito!",
            text: "Se eliminó la interfaz",
            icon: "success",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-2);
                }
        setTimeout(saludos, 2600);
       
    </script>';
        die();
    } else {
        echo '<script>
        swal.fire({
            title: "Error!",
            text: "No se eliminó la interfaz",
            icon: "error",
            showConfirmButton: false,
            timer: 2600
          });
        function saludos(){
            window.history.go(-2);
                }
        setTimeout(saludos, 2600);
       
    </script>';
    }
    ?>
</body>

</html>