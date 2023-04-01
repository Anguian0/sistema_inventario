<?php
// Llama a la conexion
require("../conexion.php");


// Añadir css en php forma 1 parte 1
define('CSSPATH', '../css/');
$cssItem = 'output.css';


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

// Si no lo está lo regresa a login, porque si no está logueado no dejara que entre a dashboard
if ($verificarlogueo == null || $verificarlogueo = "") {
    header("location: ../login.php");
    die();
    // Si está logueado se mantiene en la página
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

    <!-- Añadir css(Necesario) en php forma 1 parte 2 -->
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">

    <title>Actualizar usuario</title>

</head>

<body class="flex h-screen justify-center items-center">

    <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
        <div class="py-6 px-6 lg:px-8">
            <div class="flex justify-start items-stretch mb-3">
                <a href="../usuarios.php" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4  rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="ml-5 self-center text-xl font-medium text-gray-900">Actualiza un usuario</h3>
            </div>

            <!-- Mostrar datos de la tabla usuarios-->
            <?php
            $url = $_GET["url"];

            $obtenerdatos = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUsuario = '$url'");

            while ($consulta = mysqli_fetch_array($obtenerdatos)) {
            ?>
                <!-- Formulario -->
                <!-- Se envia al archivo actualizar_usuario_proceso.php con el id del usuario -->
                <form class="space-y-6" method="POST" action="../procesos/actualizar_usuario_proceso.php?url=<?php echo $consulta['idUsuario']; ?>">
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del usuario</label>
                        <input value="<?php echo $consulta['Usuario']; ?>" type="text" name="actualizarusuario" id="actualizarusuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required" />
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                        <input value="<?php echo base64_decode($consulta['Contrasena']); ?>" type="text" name="actualizarcontrasena" id="actualizarcontrasena" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" required="required" />
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Rol del usuario</label>
                        <select type="text" name="actualizarrol" id="actualizarrol" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5">
                            <option hidden selected><?php echo $consulta['Rol']; ?></option>
                            <option>Administrador</option>
                            <option>Personal</option>
                            <option>Lectura</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm px-5 py-2.5 text-center">Actualizar</button>
                </form>
            <?php
            }
            ?>
            <!-- Fin de formulario -->

        </div>
    </div>

</body>

</html>