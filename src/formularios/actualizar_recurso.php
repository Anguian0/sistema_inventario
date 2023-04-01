<?php
// LLama a la conexion
require("../conexion.php");

// Añadir css en php forma 1 parte 1
define('CSSPATH', '../css/');
$cssItem = 'output.css';

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

    <title>Actualizar recurso</title>
</head>

<body>
    <!-- Mostrar datos -->
    <?php
    $url = $_GET["url"];

    $obtenerdatos = mysqli_query($conexion, "SELECT * FROM recursos WHERE idRecurso = '$url'");

    while ($consulta = mysqli_fetch_array($obtenerdatos)) {
    ?>
        <div class="bg-white rounded-xl shadow-xl m-6 p-6">
            <div class="flex justify-start items-stretch mb-5">
                <a href="../acciones_recurso.php?url=<?php echo $consulta['idRecurso']; ?>" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">Actualizando el recurso #<?php echo $consulta['Numero_inventario'] ?></h3>
            </div>



            <!-- Se envia al archivo actualizar_recurso_proceso.php con el id del equipo -->
            <form method="POST" action="../procesos/actualizar_recurso_proceso.php?url=<?php echo $consulta['idRecurso'] ?>">




                <hr class="mb-4" />

                <h3 class="mb-4 text-xl font-medium text-gray-900">Revisa los datos antes de actualizar</h3>
                <div class="grid gap-6 mb-6 md:grid-cols-3">

                    <!-- {/* Número de inventario */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Número de inventario</label>
                        <input type="text" id="actualizarni" name="actualizarni" value="<?php echo $consulta['Numero_inventario'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" disabled />
                    </div>

                    <!-- {/* Tipo de equipo */} -->
                    <div>
                        <label for="" class=" block mb-2 text-sm font-medium text-gray-900">Tipo de equipo</label>
                        <select type="text" id="actualizartipo" name="actualizartipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5">
                            <!-- Mostrar datos -->
                            <?php
                            $datostipoequiposelect = mysqli_query($conexion, "SELECT t1.idRecurso, t1.Tipo_equipo_id, t2.idTipo_equipo, t2.Tipos_equipos FROM recursos t1 INNER JOIN tipo_equipo t2 ON t1.Tipo_equipo_id = t2.idTipo_equipo WHERE idRecurso = '$url' AND idTipo_equipo = Tipo_equipo_id");

                            while ($consultatipoequiposelect = mysqli_fetch_array($datostipoequiposelect)) {
                            ?>
                                <option hidden value="<?php echo $consultatipoequiposelect['idTipo_equipo']; ?>"><?php echo $consultatipoequiposelect['Tipos_equipos']; ?></option>
                            <?php
                            }
                            ?>
                            <?php
                            $datostipoequipo = mysqli_query($conexion, "SELECT * FROM `tipo_equipo` WHERE 1");

                            while ($consultatipoequipo = mysqli_fetch_array($datostipoequipo)) {
                            ?>
                                <option value="<?php echo $consultatipoequipo['idTipo_equipo']; ?>"><?php echo $consultatipoequipo['Tipos_equipos']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- {/* Marca */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Marca</label>
                        <input type="text" id="actualizarmarca" name="actualizarmarca" value="<?php echo $consulta['Marca'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Modelo */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Modelo</label>
                        <input type="text" id="actualizarmodelo" name="actualizarmodelo" value="<?php echo $consulta['Modelo'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Número de serie */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Número de serie</label>
                        <input type="text" id="actualizarnumeroserie" name="actualizarnumeroserie" value="<?php echo $consulta['Numero_serie']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Personal asignado (RFC) */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Personal asignado (RFC)</label>
                        <input type="text" id="actualizarrfc" name="actualizarrfc" value="<?php echo $consulta['RFC']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Puertos */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Puertos</label>
                        <input type="text" id="actualizarpuertos" name="actualizarpuertos" value="<?php echo $consulta['Puertos']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Descripción */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Descripción</label>
                        <textarea rows="1" type="text" id="actualizardescripcion" name="actualizardescripcion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"><?php echo $consulta['Descripcion']; ?></textarea>
                    </div>

                    <!-- {/* Observaciones */} -->
                    <div>
                        <label htmlFor="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">Observaciones</label>
                        <textarea rows="1" type="text" id="actualizarobservaciones" name="actualizarobservaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"><?php echo $consulta['Observaciones']; ?></textarea>
                    </div>

                </div>
                <hr class="my-4">
                <div class="grid gap-6 mb-6 md:grid-cols-3">

                    <!-- {/* Conectado a */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Conectado a</label>
                        <input type="text" id="actualizarconectadoa" name="actualizarconectadoa" value="<?php echo $consulta['Conectado_a'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Puerto origen */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Puerto origen</label>
                        <input type="text" id="actualizarpuertoorigen" name="actualizarpuertoorigen" value="<?php echo $consulta['Puerto_origen'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>

                    <!-- {/* Puerto destino */} -->
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Puerto destino</label>
                        <input type="text" id="actualizarpuertodestino" name="actualizarpuertodestino" value="<?php echo $consulta['Puerto_destino'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" />
                    </div>
                </div>

                <button type="submit" class="text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm w-full sm:w-auto px-5 py-2.5 text-center">Actualizar</button>
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>