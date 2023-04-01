<?php
// LLama a la conexion
require("../conexion.php");


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
    header("location: ../login.php");
    die();
    // Si esta logueado dependiendo del rol se mantiene en la pagina
} elseif ($rol == "Lectura") {
    header("location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/output.css">

    <title>Actualizar interfaz de red</title>

</head>

<body>
    <div class="bg-white rounded-xl shadow-xl m-6 p-6">
        <!-- Mostrar datos de la tabla interfaz_red -->
        <?php
        $url = $_GET["url"];

        $obtenerdatosactualizar = mysqli_query($conexion, "SELECT * FROM interfaz_red WHERE idInterfaz_red = '$url'");

        while ($consultaactualizar = mysqli_fetch_array($obtenerdatosactualizar)) {
        ?>
            <div class="flex justify-start items-stretch mb-5">
                <a href="../acciones_interfaz.php?url=<?php echo $consultaactualizar['idInterfaz_red']; ?>" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">Estás actualizando la interfaz de red <?php echo $consultaactualizar['Numero_interfaz']; ?></h3>
            </div>


            <!-- Se envia al archivo actualizar_interfaz_proceso.php con el id de la interfaz de red-->
            <form method="POST" action="../procesos/actualizar_interfaz_proceso.php?url=<?php echo $consultaactualizar['idInterfaz_red']; ?>">
            <?php
        }
            ?>

            <hr class="mb-4" />

            <h3 class="mb-4 text-xl font-medium text-gray-900">Revisa los datos antes de actualizar</h3>
            <div class="grid gap-6 mb-6 md:grid-cols-3">

                <!-- {/* Recurso */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Esta interfaz pertenece al equipo:</label>
                    <select type="text" id="actualizaridrecurso" name="actualizaridrecurso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" disabled>
                        <!-- Mostrar datos haciendo una consulta de 2 tablas, interfaz_red y recursos -->
                        <?php
                        $datosrecurso = mysqli_query($conexion, "SELECT t1.idInterfaz_red, t1.Numero_interfaz, t1.Recurso_id, t2.idRecurso, t2.Numero_inventario FROM interfaz_red t1 INNER JOIN recursos t2 ON t1.Recurso_id = t2.idRecurso WHERE idInterfaz_red = '$url'");

                        while ($consultarecurso = mysqli_fetch_array($datosrecurso)) {
                        ?>
                            <option value="<?php echo $consultarecurso['Recurso_id']; ?>"><?php echo $consultarecurso['Numero_inventario']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- {/* Número de interfaz del recurso */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Número de interfaz del equipo</label>
                    <!-- Mostrar datos de la tabla interfaz_red -->
                    <?php
                    $datosnumerointerfaz = mysqli_query($conexion, "SELECT * FROM `interfaz_red` WHERE idInterfaz_red = '$url'");

                    while ($consultanumerointerfaz = mysqli_fetch_array($datosnumerointerfaz)) {
                    ?>
                        <input type="text" id="actualizarni" name="actualizarni" value="<?php echo $consultanumerointerfaz['Numero_interfaz'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" disabled />
                    <?php
                    }
                    ?>
                </div>


                <!-- {/* Tipo de conectividad */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Tipo de conectividad</label>
                    <select type="text" id="actualizartc" name="actualizartc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5">
                        <!-- Mostrar datos de las tablas de interfaz_red y tipo_conectividad -->
                        <?php
                        $datostipocselect = mysqli_query($conexion, "SELECT t1.idInterfaz_red, t1.Numero_interfaz, t1.Tipo_conectividad_id, t2.idTipo_conectividad, t2.Tipos_conectividad FROM interfaz_red t1 INNER JOIN tipo_conectividad t2 ON t1.Tipo_conectividad_id = t2.idTipo_conectividad WHERE idInterfaz_red = '$url' AND idTipo_conectividad = Tipo_conectividad_id");

                        while ($consultatipocselect = mysqli_fetch_array($datostipocselect)) {
                        ?>
                            <option hidden value="<?php echo $consultatipocselect['idTipo_conectividad']; ?>"><?php echo utf8_encode($consultatipocselect['Tipos_conectividad']); ?></option>
                        <?php
                        }
                        ?>
                        <!-- Mostrar datos de la tabla tipo_conectividad -->
                        <?php
                        $datostipoconectividad = mysqli_query($conexion, "SELECT * FROM `tipo_conectividad` WHERE 1");

                        while ($consultatipoconectividad = mysqli_fetch_array($datostipoconectividad)) {
                        ?>
                            <option hidden>Seleciona el tipo de equipo:</option>
                            <option value="<?php echo $consultatipoconectividad['idTipo_conectividad']; ?>"><?php echo utf8_encode($consultatipoconectividad['Tipos_conectividad']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- {/* SSID */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">SSID</label>
                    <!-- Mostrar datos de la tabla interfaz_red-->
                    <?php
                    $datosssid = mysqli_query($conexion, "SELECT * FROM `interfaz_red` WHERE idInterfaz_red = '$url'");

                    while ($consultassid = mysqli_fetch_array($datosssid)) {
                    ?>
                        <input type="text" id="actualizarssid" name="actualizarssid" value="<?php echo $consultassid['SSID'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    <?php
                    }
                    ?>
                </div>

                <!-- {/* IP */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">IP</label>
                    <!-- Mostrar datos de la tabla de interfaz_red -->
                    <?php
                    $datosip = mysqli_query($conexion, "SELECT * FROM `interfaz_red` WHERE idInterfaz_red = '$url'");

                    while ($consultaip = mysqli_fetch_array($datosip)) {
                    ?>
                        <input type="text" id="actualizarip" name="actualizarip" value="<?php echo $consultaip['IP'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    <?php
                    }
                    ?>
                </div>

                <!-- {/* MAC */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">MAC</label>
                    <!-- Mostrar datos de la tabla interfaz_red-->
                    <?php
                    $datosmac = mysqli_query($conexion, "SELECT * FROM `interfaz_red` WHERE idInterfaz_red = '$url'");

                    while ($consultamac = mysqli_fetch_array($datosmac)) {
                    ?>
                        <input type="text" id="actualizarmac" name="actualizarmac" value="<?php echo $consultamac['MAC'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    <?php
                    }
                    ?>
                </div>

            </div>

            <button type="submit" class="text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm w-full sm:w-auto px-5 py-2.5 text-center">Actualizar</button>
            </form>
    </div>
</body>

</html>