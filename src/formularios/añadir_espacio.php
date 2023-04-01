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
    while($consultarol = mysqli_fetch_array($datosusuario)) {
        $rol = $consultarol['Rol'];
    }

// Si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a dashboard
if ($verificarlogueo == null || $verificarlogueo = "") {
    header("location: ../login.php");
    die();
// Si esta logueado dependiendo del rol se mantiene en la pagina
} elseif ($rol == "Operador") {
    header("location: ../dashboard.php");
} elseif ($rol == "Lectura") {
    header("location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/output.css">
    <title>Añadir espacio</title>
</head>

<body class="flex h-screen justify-center items-center mx-6">

    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="py-6 px-6 lg:px-8">
            <div class="flex justify-start items-stretch mb-3">
                <a href="../dashboard.php" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4  rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">Añade un espacio</h3>
            </div>
            <?php
            // Proceso de php para insetar registros en la tabla espacios
            if (isset($_POST['añadirnombreespacio'])) {
                $añadirnombreespacio = $_POST['añadirnombreespacio'];
                $añadirplantaespacio = $_POST['añadirplantaespacio'];
                $añadiridarea = $_POST['añadiridarea'];
                $añadirtipoespacio = $_POST['añadirtipoespacio'];

                $sql = "INSERT INTO espacios(NombreEspacio, Planta, Area_id, Tipo_espacio_id) VALUES ('$añadirnombreespacio', '$añadirplantaespacio', '$añadiridarea', '$añadirtipoespacio')";

                // Alertas
                if ($conexion->query($sql) === true) {
                    echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-xl dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium">Exito!</span><br/> Se añadió el recurso correctamente.
                      </div>';
                } else {
                    echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                        <span class="font-medium">Error al añadir!</span><br/> Lamentablemente algo salió mal.
                      </div>';
                }
            }
            ?>
            
            <!-- No se envia, el proceso se hace en este mismo archivo -->
            <form class="space-y-6" action="añadir_espacio.php" method="POST">
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Selecciona el área</label>
                    <select type="text" name="añadiridarea" id="añadiridarea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required">
                        <?php
                        // Mostrar datos de la tabla areas
                        $datos = mysqli_query($conexion, "SELECT * FROM areas WHERE 1");

                        while ($consulta = mysqli_fetch_array($datos)) {
                        ?>
                            <option hidden selected disabled>Selecciona un área</option>
                            <option value="<?php echo $consulta['idArea']; ?>"><?php echo $consulta['NombreArea']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Selecciona el tipo de espacio</label>
                    <select type="text" name="añadirtipoespacio" id="añadirtipoespacio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required">
                        <?php
                        // Mostrar datos de la tabla Tipos de Espacios
                        $datos = mysqli_query($conexion, "SELECT * FROM tipo_espacio WHERE 1");

                        while ($consulta = mysqli_fetch_array($datos)) {
                        ?>
                            <option hidden selected disabled>Selecciona un tipo de espacio</option>
                            <option value="<?php echo $consulta['idTipo_espacio']; ?>"><?php echo utf8_encode($consulta['Tipos_espacios']); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <!-- Select para seleccionar si está en la planta alta o baja el espacio -->
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Selecciona la planta:</label>
                    <select type="text" name="añadirplantaespacio" id="añadirplantaespacio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required">
                        <option hidden selected disabled>Selecciona en que planta se ubica</option>
                        <option>Alta</option>
                        <option>Baja</option>
                    </select>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del espacio</label>
                    <input type="text" name="añadirnombreespacio" id="añadirnombreespacio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" placeholder="SC1" required="required" />
                </div>
                <button type="submit" class="w-full text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm px-5 py-2.5 text-center">Añadir</button>
            </form>
        </div>
    </div>

</body>

</html>