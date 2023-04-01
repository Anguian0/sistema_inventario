<?php 
// Se llama a la conexion
include("conexion.php");

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
    <title>Interfaces de red</title>
</head>

<body>
    <!-- Mostrar datos de la tabla recursos -->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT * FROM recursos WHERE idRecurso = '$url'");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>
        <div class="bg-slate-300 m-6 rounded-xl lg:py-2.5 py-4 lg:px-6 px-4 flex justify-between flex-wrap">
            <a href="recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="fm:w-full sm:w-auto self-center bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <?php
            // Proceso de php para mostrar la cantidad de interfaces
            $url = $_GET["url"];

            $obtenerdatosc = mysqli_query($conexion, "SELECT count(Numero_interfaz) AS total FROM interfaz_red WHERE Recurso_id = '$url'");

            while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
            ?>
                <h3 class="text-xl font-medium self-center lg:mb-0 mb-2 order-first lg:order-none"><?php echo $consultac['total']; ?> Interfaces de red del Equipo: <?php echo $consulta['Numero_inventario']; ?></h3>
            <?php
            }
            ?>
            <a href="formularios/añadir_interfaz.php?url=<?php echo $consulta['idRecurso']; ?>" class="text-green-600 border border-green-600 bg-green-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex justify-center">
                Añadir interfaz
            </a>
        </div>
    <?php
    }
    ?>

    <!-- Mostrar datos de las tablas interfaz_red y tipo_conectividad-->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT t1.idInterfaz_red, t1.Numero_interfaz, t1.Tipo_conectividad_id, t1.SSID, t1.IP, t1.MAC, t2.idTipo_conectividad, t2.Tipos_conectividad, t3.idRecurso, t3.Numero_inventario FROM interfaz_red t1 INNER JOIN tipo_conectividad t2 ON t1.Tipo_conectividad_id = t2.idTipo_conectividad INNER JOIN recursos t3 ON t1.Recurso_id = t3.idRecurso WHERE idRecurso = '$url' ORDER BY Numero_interfaz ASC");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>

        <div class="bg-slate-300 rounded-xl p-6 m-6 text-gray-900">
            <div class="flex justify-between flex-wrap items-stretch">
                <h3 class="text-xl font-medium self-center lg:mb-0 mb-2 order-first lg:order-none">Interfaz de red <?php echo $consulta['Numero_interfaz']; ?></h3>
                <div class="fm:mt-1 fm:w-full sm:mt-0 sm:w-auto rounded-xl flex justify-evenly right-0 order-last flex-wrap">
                    <!-- Manda al archivo de acciones_interfaz.php con el id de la interfaz para poder actualizar o eliminar la interfaz -->
                    <a href="acciones_interfaz.php?url=<?php echo $consulta['idInterfaz_red']; ?>" class="text-yellow-600 border border-yellow-600 bg-yellow-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex justify-center">
                        Acciones
                    </a>
                </div>
            </div>
            <br />

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                <!-- Tipo de conectividad -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Tipo de conectividad:</h3>
                    <p><?php echo utf8_encode($consulta['Tipos_conectividad']); ?></p>
                </div>


                <!-- SSID -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">SSID:</h3>
                    <p><?php echo $consulta['SSID']; ?></p>
                </div>


                <!-- IP -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">IP:</h3>
                    <p><?php echo $consulta['IP']; ?></p>
                </div>


                <!-- MAC -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">MAC:</h3>
                    <p><?php echo $consulta['MAC']; ?></p>
                </div>
            </div>

        </div>

    <?php
    }
    ?>
</body>

</html>