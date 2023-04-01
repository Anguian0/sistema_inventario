<?php
// Llama a la conexion
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
    <title>Recurso</title>
</head>

<body>
    <div class="bg-slate-300 rounded-xl p-6 m-6 text-gray-900">
        <!-- Mostrar datos de la tabla recursos -->
        <?php
        $url = $_GET["url"];

        $obtenerdatos = mysqli_query($conexion, "SELECT * FROM recursos WHERE idRecurso = '$url'");

        while ($consulta = mysqli_fetch_array($obtenerdatos)) {
        ?>
            <div class="flex justify-between flex-wrap items-stretch">
                <a href="../src/equipos.php?url=<?php echo $consulta['Espacio_id']; ?>" class="fm:w-full sm:w-auto self-center bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center lg:mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="text-xl font-medium self-center lg:mb-0 mb-2 order-first lg:order-none mx-auto">EQUIPO: <?php echo $consulta['Numero_inventario']; ?></h3>
                <div class="fm:mt-1 fm:w-full sm:mt-0 sm:w-auto rounded-xl flex justify-evenly right-0 order-last flex-wrap">
                    <!-- Personal asignado -->
                    <a href="personal.php?url=<?php echo $consulta['idRecurso']; ?>&rfc=<?php echo $consulta['RFC']; ?>" class="text-orange-600 border border-orange-600 bg-orange-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex justify-center">
                        Personal asignado
                    </a>
                    <!-- Interfaces de red -->
                    <a href="interfaces.php?url=<?php echo $consulta['idRecurso']; ?>" class="text-indigo-600 border border-indigo-600 bg-indigo-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex justify-center lg:mx-3">
                        Interfaces de red
                    </a>
                    <!-- Manda a la pagina de acciones_recuso.php el id del equipo para poder actualizar o eliminar el recurso -->
                    <a href="acciones_recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="text-yellow-600 border border-yellow-600 bg-yellow-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex justify-center">
                        Acciones
                    </a>
                </div>
            </div>
            <br />

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div class=" bg-gray-100 rounded-xl">
                    <img src="img/<?php echo $consulta['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="w-full cover rounded-xl">
                </div>

                <!-- Número inventario -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Código de inventario:</h3>
                    <p><?php echo $consulta['Numero_inventario']; ?></p>
                </div>

                <!-- Área -->
                <!-- Mostrar datos de las tablas recursos y areas -->
                <?php

                $obtenerdatosarea = mysqli_query($conexion, "SELECT t1.idRecurso, t1.Marca, t1.Area_id, t2.idArea, t2.NombreArea FROM recursos t1 INNER JOIN areas t2 ON t1.Area_id = t2.idArea WHERE Area_id = idArea AND idRecurso = '$url'");

                while ($consultaarea = mysqli_fetch_array($obtenerdatosarea)) {
                ?>
                    <div class="p-3 px-4 bg-gray-100 rounded-xl">
                        <h3 class="font-bold">Área:</h3>
                        <p><?php echo $consultaarea['NombreArea']; ?></p>
                    </div>
                <?php
                }
                ?>

                <!-- Espacio -->
                <!-- Muestra datos de las tablas recursos y espacios -->
                <?php

                $obtenerdatosespacio = mysqli_query($conexion, "SELECT t1.idRecurso, t1.Espacio_id, t2.idEspacio, t2.NombreEspacio FROM recursos t1 INNER JOIN espacios t2 ON t1.Espacio_id = t2.idEspacio WHERE Espacio_id = idEspacio AND idRecurso = '$url'");

                while ($consultaespacio = mysqli_fetch_array($obtenerdatosespacio)) {
                ?>
                    <div class="p-3 px-4 bg-gray-100 rounded-xl">
                        <h3 class="font-bold">Espacio:</h3>
                        <p><?php echo $consultaespacio['NombreEspacio']; ?></p>
                    </div>
                <?php
                }
                ?>

                <!-- Tipo equipo -->
                <!-- Muestra datos de las tablas recursos y tipo_equipo -->
                <?php

                $obtenerdatostipoequipo = mysqli_query($conexion, "SELECT t1.idRecurso, t1.Tipo_equipo_id, t2.idTipo_equipo, t2.Tipos_equipos FROM recursos t1 INNER JOIN tipo_equipo t2 ON t1.Tipo_equipo_id = t2.idTipo_equipo WHERE Tipo_equipo_id = idTipo_equipo AND idRecurso = '$url'");

                while ($consultatipoequipo = mysqli_fetch_array($obtenerdatostipoequipo)) {
                ?>
                    <div class="p-3 px-4 bg-gray-100 rounded-xl">
                        <h3 class="font-bold">Tipo equipo:</h3>
                        <p><?php echo $consultatipoequipo['Tipos_equipos']; ?></p>
                    </div>
                <?php
                }
                ?>




                <!-- Marca -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Marca:</h3>
                    <p><?php echo $consulta['Marca']; ?></p>
                </div>

                <!-- Modelo -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Modelo:</h3>
                    <p><?php echo $consulta['Modelo']; ?></p>
                </div>

                <!-- Número de serie -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Número de serie:</h3>
                    <p><?php echo $consulta['Numero_serie']; ?></p>
                </div>

                <!-- Puertos -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Puertos:</h3>
                    <p><?php echo $consulta['Puertos']; ?></p>
                </div>

                <!-- Descripción -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Descripción</h3>
                    <p><?php echo $consulta['Descripcion']; ?></p>
                </div>

                <!-- Observaciones -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Observaciones:</h3>
                    <p><?php echo $consulta['Observaciones']; ?></p>
                </div>

            </div>

            <br>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <!-- Conectado a -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Conectado a:</h3>
                    <p><?php echo $consulta['Conectado_a']; ?></p>
                </div>

                <!-- Puerto origen -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Puerto origen:</h3>
                    <p><?php echo $consulta['Puerto_origen']; ?></p>
                </div>

                <!-- Puerto destino -->
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Puerto destino:</h3>
                    <p><?php echo $consulta['Puerto_destino']; ?></p>
                </div>


            </div>

        <?php
        }
        ?>
    </div>
</body>

</html>