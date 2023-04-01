<?php
// Llama a la conexion
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
    // Si esta logueado dependiendo del rol se mantiene en la pagina
} elseif ($rol == "Operador") {
    header("location: ../index.php");
} elseif ($rol == "Lectura") {
    header("location: ../index.php");
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
    <title>Usuarios</title>
</head>

<body>
    <div class="bg-slate-300 m-6 rounded-xl lg:py-2.5 py-4 lg:px-6 px-4 flex justify-between flex-wrap">
        <a href="dashboard.php" class="fm:w-full sm:w-auto self-center bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="fm:mt-1 fm:w-full sm:mt-0 sm:w-auto rounded-xl flex justify-evenly right-0">
            <a href="formularios/añadir_usuario.php" class="text-green-600 border border-green-600 bg-green-50 px-4 py-2 rounded-xl fm:mt-2 fm:w-full sm:mt-0 sm:w-auto flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6 mr-1.5">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                Añadir usuario
            </a>
        </div>
    </div>

    <div class="bg-slate-300 rounded-xl p-4 lg:p-6 mx-6 text-gray-900">

        <div class="bg-gray-100 p-3 mb-3 rounded-xl flex justify-around flex-wrap font-semibold">
            <p><span class="font-bold">Administrdor:</span> Tiene acceso a todo.</p>
            <p class="lg:my-0 my-2"><span class="font-bold">Operador:</span> Solo puede agregar recursos</p>
            <p><span class="font-bold">Lectura:</span> Como su nombre indica solo es para lectura</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            <!-- Mostrar datos de la tabla usuarios -->
            <?php
            $obtenerdatos = mysqli_query($conexion, "SELECT * FROM usuarios WHERE 1");

            while ($consulta = mysqli_fetch_array($obtenerdatos)) {
            ?>
                <div class="p-3 px-4 bg-gray-100 rounded-xl">
                    <h3 class="font-bold">Datos</h3>
                    <li>Usuario: <?php echo $consulta['Usuario']; ?></li>
                    <li>Contraseña: <?php echo base64_decode($consulta['Contraseña']); ?></li>
                    <hr class="my-3" />
                    <h3 class="font-bold">Rol:</h3>
                    <li><?php echo $consulta['Rol']; ?></li>
                    <hr class="my-3" />
                    <div class="flex">

                        <!-- Manda el id del usuario al archivo actualizar_usuario.php para actualizar -->
                        <a href="formularios/actualizar_usuario.php?url=<?php echo $consulta['idUsuario']; ?>" class="mr-2 border border-blue-600 bg-blue-50 text-blue-600 rounded-xl py-1 px-3" type="submit">
                            Actualizar
                        </a>

                        <!-- Procesos de PHP para eliminar un usuario por medio del id del mismo -->
                        <?php
                        if (isset($_POST['eliminarusuario'])) {
                            $id = $_POST['eliminarusuario'];
                            $eliminardatos = "DELETE FROM usuarios WHERE idUsuario = '$id'";

                            $resultado = mysqli_query($conexion, $eliminardatos);
                            if ($resultado) {
                                echo '<script type="text/javascript">
                                window.location.assign("usuarios.php");
                                </script>';
                                die();
                            }
                        }
                        ?>

                        <!-- No se envia, en este mismo archivo se hace el proceso de eliminar el usuario -->
                        <form method="POST" id="<?php echo $consulta['idUsuario']; ?>" action="">
                            <input type="hidden" name="eliminarusuario" value="<?php echo $consulta['idUsuario']; ?>">
                            <button class="border border-red-600 bg-red-50 text-red-600 rounded-xl py-1 px-3" type="submit">
                                Eliminar
                            </button>
                        </form>

                    </div>
                </div>
            <?php
            }
            ?>
            <!-- Fin mostrar datos -->
        </div>
    </div>
</body>

</html>