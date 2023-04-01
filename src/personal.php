<?php
// LLama a la conexion
require("conexion.php");

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
    <title>Personal asignado</title>
</head>

<body>
    <!-- Mostrar datos de la tabla recursos -->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT * FROM recursos WHERE idRecurso = '$url'");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>
    <div class="bg-slate-300 m-6 rounded-xl lg:py-2.5 py-4 lg:px-6 px-4 flex flex-wrap">
        <a href="recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="fm:w-full sm:w-auto self-center bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h3 class="text-xl font-medium self-center lg:mb-0 mb-2 order-first lg:order-none lg:ml-5">Personal asignado del equipo: <?php echo $consulta['Numero_inventario']; ?></h3>
    </div>
    <?php
    }
    ?>

    <div class="bg-slate-300 rounded-xl p-4 lg:p-6 mx-6 text-gray-900">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            <?php
            // Llama a la conexion de la base de datos del sii
            include("conexion2.php");

            // Mostrar datos de la tabla que contiene la informacion de el personal asignado
            $rfc = $_GET["rfc"];

            $obtenerdatosrfc = mysqli_query($conexion2, "SELECT * FROM prueba WHERE RFC = '$rfc'");

            while ($consultarfc = mysqli_fetch_array($obtenerdatosrfc)) {
            ?>
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">RFC:</h3>
                    <p><?php echo $consultarfc['RFC']; ?></p>
                </div>
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Nombre:</h3>
                    <p><?php echo $consultarfc['Nombre']; ?></p>
                </div>
            <?php
            }
            ?>
            <!-- Fin mostrar datos -->
        </div>
    </div>
</body>

</html>