<?php 
// Se llama a la conexion
include("conexion.php");

// Usuario
// Llama a la sesion del usuario
session_start();

// Verifica si el usuario esta logueado
$verificarlogueo = $_SESSION['Usuariologin'];

// Busca los datos del usuario logueado
$datosusuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario = '$verificarlogueo'");

// Para obtener el rol del usuario logueado
while ($consultarol = mysqli_fetch_array($datosusuario)) {
    $rol = $consultarol['Rol'];
}

// Si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a dashboard
if ($verificarlogueo == null || $verificarlogueo = "") {
    header("location: login.php");
    die();
    // Si esta logueado dependiendo del rol se mantiene en la pagina
} elseif ($rol == "Lectura") {
    header("location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/output.css">
    <title>Acciones</title>
</head>

<body class="flex h-screen justify-center items-center mx-6">

    <!-- Consulta de la tabla recursos -->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT * FROM recursos WHERE idRecurso = '$url'");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="py-6 px-6 lg:px-8">
                <div class="flex justify-start items-stretch mb-3">
                    <a href="recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4  rounded-xl flex cursor-pointer justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">¿Qué desea hacer?</h3>
                </div>
                <!-- Actualiza por medio del id del equipo que se manda por url al archivo actualizar_recurso.php -->
                <a href="formularios/actualizar_recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="text-blue-600 border border-blue-600 bg-blue-50 px-4 py-2 rounded-xl flex justify-center w-full">
                    Actualizar
                </a>
                <!-- Elimina por medio de id del equipo que se manda por url al archivo aliminar_recurso_proceso.php -->
                <a href="procesos/eliminar_recurso_proceso.php?url=<?php echo $consulta['idRecurso']; ?>" class="text-red-600 border border-red-600 bg-red-50 px-4 py-2 rounded-xl flex justify-center w-full mt-3">
                    Eliminar
                </a>
            </div>
        </div>

    <?php
    }
    ?>
</body>


</html>