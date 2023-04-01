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
    <title>Acciones Interfaz</title>
</head>

<body class="flex h-screen justify-center items-center mx-6">

    <!-- Mostrar datos de las tablas de interfaz_red y tipo_conectividad-->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT t1.idInterfaz_red, t1.Numero_interfaz, t1.Tipo_conectividad_id, t1.SSID, t1.IP, t1.MAC, t2.idTipo_conectividad, t2.Tipos_conectividad, t3.idRecurso, t3.Numero_inventario FROM interfaz_red t1 INNER JOIN tipo_conectividad t2 ON t1.Tipo_conectividad_id = t2.idTipo_conectividad INNER JOIN recursos t3 ON t1.Recurso_id = t3.idRecurso WHERE idInterfaz_red = '$url'");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="py-6 px-6 lg:px-8">
                <div class="flex justify-start items-stretch mb-3">
                    <a href="interfaces.php?url=<?php echo $consulta['idRecurso']; ?>" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4  rounded-xl flex cursor-pointer justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">¿Qué desea hacer?</h3>
                </div>
                <!-- Actualiza por medio del id de la interfaz que se manda por url al archivo actualizar_interfaz.php -->
                <a href="formularios/actualizar_interfaz.php?url=<?php echo $consulta['idInterfaz_red']; ?>" class="text-blue-600 border border-blue-600 bg-blue-50 px-4 py-2 rounded-xl flex justify-center w-full">
                    Actualizar
                </a>
                <!-- Elimina por medio de id de la interfaz que se manda por url al archivo elimimar_interfaz_proceso.php -->
                <a href="procesos/eliminar_interfaz_proceso.php?url=<?php echo $consulta['idInterfaz_red']; ?>" class="text-red-600 border border-red-600 bg-red-50 px-4 py-2 rounded-xl flex justify-center w-full mt-3">
                    Eliminar
                </a>
            </div>
        </div>

    <?php
    }
    ?>
</body>


</html>