<?php
// Se llama a la conexion
require("conexao.php");

// Para quitar el aviso de error de Usuariologin indefinido, esto pasa porque no hay un usaurio logueado aun.
error_reporting(0);

// Llamado de sesion
session_start();

// Verifica si el usuario esta logueado, si es asi lo regresa a index, porque si ya esta logueado no es necesario entrar a login
$verificarlogueo = $_SESSION['Usuariologin'];
if ($verificarlogueo != "") {
    header("location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/output.css">
    <title>Login</title>

</head>

<body class="flex h-screen justify-center items-center">

    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full mx-2 lg:mx-0">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <img src="img/ittux.webp" class="h-full w-auto object-cover rounded-t-xl lg:rounded-l-xl lg:rounded-r-none" alt="">
            </div>
            <div class="p-6 lg:p-10 lg:px-8">
                <h1 class="text-xl mb-4 font-bold text-gray-700 lg:text-2xl">
                    Inicia sesión
                </h1>

                <!-- Validación de usuario y contraseña para el inicio de sesión -->
                <?php
                if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
                    $usuario = $_POST['usuario'];
                    $contraseña = $_POST['contrasena'];

                    $query_login = $conn->prepare("SELECT * FROM usuarios WHERE Usuario = '$usuario'");
                    $query_login->execute();

                    $usuar = $query_login->fetchAll(PDO::FETCH_ASSOC);
                    $contador = 0;
                    foreach ($usuar as $usua) {
                        $contador = $contador + 1;
                        $usuario_tb = $usua['Usuario'];
                        $contraseña_tb = base64_decode($usua['Contrasena']);
                    }

                    if ($contador == "0") {
                        // Si no hay un usuario registrado con ese nombre sale una alerta, si hay un usuario sigue con el if
                        echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                        <span class="font-medium">Lo siento!</span><br/> El usuario no existe.
                        </div>';
                    } else {
                        // Si los datos son correctos, llama a la sesion del usuario y lo redirecciona al index.php
                        if ($contraseña === $contraseña_tb) {
                            session_start();
                            $_SESSION['Usuariologin'] = $usuario;
                            echo '<script type="text/javascript">
                            window.location.assign("../index.php");
                            </script>';
                            die();
                        } else {
                            // Si los datos son incorrectos sale una alerta
                            echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">Lo siento!</span><br/> El usuario y contraseña son incorrectos.
                            </div>';
                        }
                    }
                }
                ?>

                <!-- No envia a otro archivo, el proceso se hace en este mismo archivo. -->
                <form class="space-y-4 md:space-y-6" action="login.php" method="POST">
                    <div>
                        <label for="" class="block mb-2 text-md font-medium text-gray-900 ">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Escribe tu usuario" required="required" />
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-md font-medium text-gray-900">Contraseña</label>
                        <input autocomplete="off" type="password" name="contrasena" id="contrasena" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="required" />
                    </div>
                    <button type="submit" class="w-full text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">Entrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>