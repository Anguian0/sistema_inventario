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

// Si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a dashboard
if ($verificarlogueo == null || $verificarlogueo = "") {
    header("location: ../login.php");
    die();
    // Si esta logueado se mantiene en la pagina
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
    <!-- Añadir css en php forma 1 parte 2 -->
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
    <title>Añadir usuario</title>
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
                <h3 class="ml-5 self-center text-xl font-medium text-gray-900">Añade un usuario</h3>
            </div>

            <!-- Formulario -->
            <?php
            // Proceso de php para insetar registros en la tabla usuarios
            if (isset($_POST['nombreusuario'])) {
                $nombreusuario = $_POST['nombreusuario'];
                $contrasenausuario = $_POST['contrasenausuario'];
                $rolusuario = $_POST['rolusuario'];
                $contrasenausuario_codificado = base64_encode($contrasenausuario);

                // Verificación de si ya existe el usuario con el mismo nombre
                $verificacion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario = '$nombreusuario'");
                $r = mysqli_num_rows($verificacion);
                if ($r > 0) {
                    echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">Lo siento!</span><br/> El usuario ya existe.
                  </div>';
                    exit;
                }

                // Se añade el usuario
                $sql = "INSERT INTO usuarios(Usuario, Contrasena, Rol) VALUES ('$nombreusuario', '$contrasenausuario_codificado', '$rolusuario')";

                // Alertas
                if ($conexion->query($sql) === true) {
                    echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-xl dark:bg-green-200 dark:text-green-800" role="alert">
                    <span class="font-medium">Exito!</span><br/> Se añadió el usuario correctamente.
                  </div>';
                } else {
                    echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">Error al añadir!</span><br/> Lamentablemente algo salió mal.
                  </div>';
                }
            }
            mysqli_close($conexion);
            ?>

            <!-- No se envia, el proceso se hace en este mismo archivo -->
            <form class="space-y-6" method="POST" action="añadir_usuario.php">
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del usuario</label>
                    <input type="text" name="nombreusuario" id="nombreusuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" placeholder="Usuario" required="required" />
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                    <input type="text" name="contrasenausuario" id="contrasenausuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5" placeholder="Contraseña" required="required" />
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Rol del usuario</label>
                    <select type="text" name="rolusuario" id="rolusuario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl  block w-full p-2.5">
                        <option hidden selected>Selecciona un rol</option>
                        <option>Administrador</option>
                        <option>Operador</option>
                        <option>Lectura</option>
                    </select>
                </div>
                <button type="submit" class="w-full text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm px-5 py-2.5 text-center">Añadir</button>
            </form>
            <!-- Fin de formulario -->

        </div>
    </div>

</body>

</html>