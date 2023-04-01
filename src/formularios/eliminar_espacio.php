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
    <title>Eliminar espacio</title>
</head>

<body class="flex h-screen justify-center items-center">

    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="py-6 px-6 lg:px-8">
            <div class="flex justify-start items-stretch mb-3">
                <a href="../dashboard.php" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4  rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="ml-5 text-xl font-medium text-gray-900 self-center">Elimina un espacio</h3>
            </div>

            <!-- El formulario se envia al archivo eliminar_espacio_proceso.php -->
            <form class="space-y-6" method="POST" action="../procesos/eliminar_espacio_proceso.php">

                <!-- Area -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Selecciona el área</label>
                    <select type="text" name="area" id="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required">
                        <?php
                        // Mostrar datos de la tabla areas
                        $datos = mysqli_query($conexion, "SELECT * FROM `areas` WHERE 1");

                        while ($consulta = mysqli_fetch_array($datos)) {
                        ?>
                            <option hidden selected disabled>Seleciona un área</option>
                            <option value="<?php echo $consulta['idArea']; ?>"><?php echo $consulta['NombreArea']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- Espacio -->
                <!-- Aquí se devuelve lo del archivo eliminar_espacio_select.php -->
                <div id="selectespacio"></div>


                <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

</body>
<!-- Script de JQUERY necesario para el funcionamiento del select del input espacio. -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<!-- Scripts necesarios para el funcionamiento del select del input espacio -->
<script type="text/javascript">
    $(document).ready(function() {
        //Para añadir el valor inicial en el select de Selecciona el área
        //$('#añadirarea').val(2);
        recargarLista();

        $('#area').change(function() {
            recargarLista();
        });
    })
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "eliminar_espacio_select.php",
            data: "NombreArea=" + $('#area').val(),
            success: function(r) {
                $('#selectespacio').html(r);
            }
        });
    }
</script>

</html>