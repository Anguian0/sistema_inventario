<?php
// Llama a la conexion
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
    <title>Añadir interfaz de red</title>
</head>

<body>
    <div class="bg-white rounded-xl shadow-xl m-6 p-6">
        <div class="flex justify-start items-stretch mb-5">
            <?php
            // Mostrar datos para poder regresar con el botón
            $url = $_GET["url"];
            $datosr = mysqli_query($conexion, "SELECT * FROM `recursos` WHERE idRecurso = '$url'");

            while ($consultar = mysqli_fetch_array($datosr)) {
            ?>
                <a href="../interfaces.php?url=<?php echo $consultar['idRecurso']; ?>" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
            <?php
            }
            ?>
            <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">Añade una interfaz de red</h3>
        </div>

        <?php
        // Proceso de php para insetar registros en la interfaz_red
        if (isset($_POST['numerointerfaz'])) {
            $numerointerfaz = $_POST['numerointerfaz'];
            $ssid = $_POST['ssid'];
            $ip = $_POST['ip'];
            $mac = $_POST['mac'];
            $url = $_GET['url'];
            $tipoconectividadid = $_POST['tipoconectividadid'];

            $sql = "INSERT INTO interfaz_red(Numero_interfaz, SSID, IP, MAC, Recurso_id, Tipo_conectividad_id) VALUES ('$numerointerfaz', '$ssid', '$ip', '$mac', '$url', '$tipoconectividadid')";


            // Alertas
            if ($conexion->query($sql) === true) {
                echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-xl dark:bg-green-200 dark:text-green-800" role="alert">
                    <span class="font-medium">Exito!</span><br/> Se añadió la interfaz correctamente.
                  </div>';
            } else {
                echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">Error al añadir!</span><br/> Lamentablemente algo salió mal.
                  </div>';
            }
        }
        ?>

        <!-- No se envia, el proceso se hace en este mismo archivo -->
        <form method="POST" action="#">
            <div class="grid gap-6 mb-6 md:grid-cols-3">



                <!-- {/* Número de interfaz del recurso */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Número de interfaz del equipo</label>
                    <input type="number" id="numerointerfaz" name="numerointerfaz" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Aquí va el número de la interfaz">
                </div>


                <!-- {/* Tipo de conectividad */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Tipo de conectividad</label>
                    <select type="text" id="tipoconectividadid" name="tipoconectividadid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5">
                        <?php
                        // Muestra datos de la tabla Tipo_conectividad, esto para mostrar en el select los tipos de conectividad que hay
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
                    <input type="text" id="ssid" name="ssid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Solo aplica para inalámbrico" />
                </div>

                <!-- {/* IP */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">IP</label>
                    <input type="text" id="ip" name="ip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="192.228.17.57" />
                </div>

                <!-- {/* MAC */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">MAC</label>
                    <input type="text" id="mac" name="mac" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="00:1B:44:11:3A:B7" />
                </div>

            </div>

            <button type="submit" class="text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm w-full sm:w-auto px-5 py-2.5 text-center">Añadir</button>
        </form>
    </div>
</body>

</html>