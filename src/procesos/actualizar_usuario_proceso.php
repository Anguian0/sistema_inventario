<!DOCTYPE html>
<html lang="en">

<!-- Este archivo es el proceso del archivo actualizar_usuario.php -->

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

    // Proceso de PHP para actualizar registros de la tabla usuarios
    // Aquí se obtiene el dato enviado por el url desde el archivo actualizar_recurso.php
    $url = $_GET["url"];

    $actualizarusuario = $_POST['actualizarusuario'];
    $actualizarcontrasena = base64_encode($_POST['actualizarcontrasena']);
    $actualizarrol = $_POST['actualizarrol'];

    $actualizardatos = "UPDATE usuarios SET Usuario='$actualizarusuario', Contrasena='$actualizarcontrasena', Rol='$actualizarrol' WHERE idUsuario = '$url'";

    // Alertas de sweetalert2
    if ($conexion->query($actualizardatos) === true) {
        echo '<script>
        swal.fire({
            title: "Éxito!",
            text: "Se actualizó el usuario",
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
            text: "No se actualizó el usuario",
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