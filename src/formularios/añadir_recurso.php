<?php
// Llama a las conexiones de las bases de datos
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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/output.css">
    <title>Añadir recurso</title>
    <!-- Script de JQUERY necesario para el funcionamiento del select del input espacio y autocompletado de input conectadoa y Personal asignado -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- Scripts necesarios para el funcionamiento del select del input espacio -->
    <script type="text/javascript">
        $(document).ready(function() {
            //Para añadir el valor inicial en el select de Selecciona el área
            //$('#añadirarea').val(2);
            recargarLista();

            $('#añadirarea').change(function() {
                recargarLista();
            });
        })
    </script>
    <script type="text/javascript">
        function recargarLista() {
            $.ajax({
                type: "POST",
                url: "añadir_recurso_select.php",
                data: "NombreArea=" + $('#añadirarea').val(),
                success: function(r) {
                    $('#selectespacio').html(r);
                }
            });
        }
    </script>
    <!-- Script necesario para el autocompletado de conectadoa -->
    <script>
        $(document).ready(function() {
            $('#conectadoa').on('keyup', function() {
                var key = $(this).val();
                var dataString = 'key=' + key;
                $.ajax({
                    type: "POST",
                    url: "autocompletar.php",
                    data: dataString,
                    success: function(data) {
                        //Escribimos las sugerencias que nos manda la consulta
                        $('#suggestions').fadeIn(1000).html(data);
                        //Al hacer click en algua de las sugerencias
                        $('.suggest-element').on('click', function() {
                            //Obtenemos la id unica de la sugerencia pulsada
                            var id = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#conectadoa').val($('#' + id).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestions').fadeOut(1000);
                            ('Has seleccionado el ' + id + ' ' + $('#' + id).attr('data'));
                            return false;
                        });
                    }
                });
            });
        });
    </script>
    <!-- Script necesario para el autocompletado de Personal asignado -->
    <script>
        $(document).ready(function() {
            $('#añadirrfc').on('keyup', function() {
                var keyrfc = $(this).val();
                var dataString = 'key=' + keyrfc;
                $.ajax({
                    type: "POST",
                    url: "autocompletarrfc.php",
                    data: dataString,
                    success: function(data) {
                        //Escribimos las sugerencias que nos manda la consulta
                        $('#suggestionsrfc').fadeIn(1000).html(data);
                        //Al hacer click en algua de las sugerencias
                        $('.suggest-elementrfc').on('click', function() {
                            //Obtenemos la id unica de la sugerencia pulsada
                            var id = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#añadirrfc').val($('#' + id).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#suggestionsrfc').fadeOut(1000);
                            ('Has seleccionado el ' + id + ' ' + $('#' + id).attr('data'));
                            return false;
                        });
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="bg-white rounded-xl shadow-xl m-6 p-6">
        <div class="flex justify-start items-stretch mb-5">
            <a href="../dashboard.php" class="bg-gray-100 lg:p-2 lg:px-4 p-3 px-4 rounded-xl flex cursor-pointer justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-xl font-medium text-gray-900 ml-5 self-center">Añade un equipo</h3>
        </div>

        <?php
        // Proceso de php para insetar registros en la tabla recursos
        if (isset($_POST['añadirnumeroinventario'])) {
            $añadirnumeroinventario = $_POST['añadirnumeroinventario'];
            // strtoupper cambia la letra a mayusculas
            $añadirnumeroinventario = strtoupper($añadirnumeroinventario);
            $añadirmarca = $_POST['añadirmarca'];
            $añadirmodelo = $_POST['añadirmodelo'];
            $añadirnumeroserie = $_POST['añadirnumeroserie'];
            $añadirdescripcion = $_POST['añadirdescripcion'];
            $añadirobservaciones = $_POST['añadirobservaciones'];
            $conectadoa = $_POST['conectadoa'];
            $añadirpuertoorigen = $_POST['añadirpuertoorigen'];
            $añadirpuertodestino = $_POST['añadirpuertodestino'];
            $añadirpuertos = $_POST['añadirpuertos'];
            $añadirrfc = $_POST['añadirrfc'];
            $añadirarea = $_POST['añadirarea'];
            $añadirespacio = $_POST['añadirespacio'];
            $añadirtipo = $_POST['añadirtipo'];

            $sql = "INSERT INTO recursos(Numero_inventario, Marca, Modelo, Numero_serie, Descripcion, Observaciones, Conectado_a, Puerto_origen, Puerto_destino, Puertos, RFC, Area_id, Espacio_id, Tipo_equipo_id) VALUES ('$añadirnumeroinventario', '$añadirmarca', '$añadirmodelo', '$añadirnumeroserie', '$añadirdescripcion', '$añadirobservaciones', '$conectadoa', '$añadirpuertoorigen', '$añadirpuertodestino', '$añadirpuertos', '$añadirrfc', '$añadirarea', '$añadirespacio', '$añadirtipo')";


            // Verifica si numero de inventario esta ocupado en otro recurso
            $verificar_numeroinventario = mysqli_query($conexion, "SELECT * FROM recursos WHERE Numero_inventario = '$añadirnumeroinventario'");
            if (mysqli_num_rows($verificar_numeroinventario) > 0) {
                echo '<div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-xl" role="alert">
                <span class="font-medium">Espera!</span><br/> El código de inventario ya existe.
              </div>';
                exit;
            }


            // Alertas
            if ($conexion->query($sql) === true) {
                echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-xl" role="alert">
                    <span class="font-medium">Exito!</span><br/> Se añadió el equipo correctamente.
                  </div>';
            } else {
                echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-xl" role="alert">
                    <span class="font-medium">Error al añadir!</span><br/> Lamentablemente algo salió mal.
                  </div>';
            }
        }
        ?>
        <form method="POST">
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <!-- {/* Código de inventario */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Código de inventario:</label>
                    <input type="text" id="añadirnumeroinventario" name="añadirnumeroinventario" class="uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="ITTUX000" />
                </div>

                <!-- {/* Selecciona el área */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Selecciona el área:</label>
                    <select type="text" id="añadirarea" name="añadirarea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" required="">
                        <!-- Mostrar datos de la tabla Areas -->
                        <?php
                        $datos = mysqli_query($conexion, "SELECT * FROM `areas` WHERE 1");

                        while ($consulta = mysqli_fetch_array($datos)) {
                        ?>
                            <option hidden selected disabled>Seleciona un área:</option>
                            <option value="<?php echo $consulta['idArea']; ?>"><?php echo $consulta['NombreArea']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>


                <!-- {/* Selecciona el espacio */} -->
                <!-- Aquí se devuelve lo del archivo añadir_recurso_select.php -->
                <div id="selectespacio"></div>


                <!-- {/* Tipo de equipo */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tipo de equipo:</label>
                    <select type="text" id="añadirtipo" name="añadirtipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Flowbite" required="">
                        <?php
                        // Mostrar datos de la tabla tipo_equipo, esto para motrar los tipos de equipos que hay
                        $datostipoequipo = mysqli_query($conexion, "SELECT * FROM `tipo_equipo` WHERE 1");

                        while ($consultatipoequipo = mysqli_fetch_array($datostipoequipo)) {
                        ?>
                            <option hidden>Seleciona el tipo de equipo:</option>
                            <option value="<?php echo $consultatipoequipo['idTipo_equipo']; ?>"><?php echo $consultatipoequipo['Tipos_equipos']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- {/* Marca */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Marca:</label>
                    <input type="text" id="añadirmarca" name="añadirmarca" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Hp" required="" />
                </div>

                <!-- {/* Modelo */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Modelo:</label>
                    <input type="text" id="añadirmodelo" name="añadirmodelo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="H48DHI29K" />
                </div>

                <!-- {/* Número de serie */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Número de serie:</label>
                    <input type="text" id="añadirnumeroserie" name="añadirnumeroserie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="18274637" />
                </div>

                <!-- {/* RFC */} -->
                <div>
                    <label for="añadirrfc" class="block mb-2 text-sm font-medium text-gray-900 ">Personal asignado (RFC):</label>
                    <input autocomplete="off" type="text" id="añadirrfc" name="añadirrfc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Escribe el RFC del personal asignado" required="required" />
                    <div class="p-2 absolute bg-white rounded-xl shadow-xl" id="suggestionsrfc"></div>
                </div>


                <!-- {/* Puertos */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Puertos:</label>
                    <input type="text" id="añadirpuertos" name="añadirpuertos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Escribe la cantidad de puertos del equipo" />
                </div>

                <!-- {/* Descripción */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Descripción:</label>
                    <textarea rows="1" type="text" id="añadirdescripcion" name="añadirdescripcion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Descibe las carácteristicas del equipo"></textarea>
                </div>

                <!-- {/* Observaciones */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Observaciones:</label>
                    <textarea rows="1" type="text" id="añadirobservaciones" name="añadirobservaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Detalles adicionales"></textarea>
                </div>

            </div>

            <hr class="my-4">
            <div class="grid gap-6 mb-6 md:grid-cols-3">

                <!-- {/* Conectado a */} -->
                <div>
                    <label for="conectadoa" class="block mb-2 text-sm font-medium text-gray-900">Conectado a:</label>
                    <input autocomplete="off" type="text" id="conectadoa" name="conectadoa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" required="" placeholder="Escribe el código de inventario" />
                    <div class="p-2 absolute bg-white rounded-xl shadow-xl"  id="suggestions"></div>
                </div>




                <!-- {/* Puerto origen */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Puerto origen:</label>
                    <input type="text" id="añadirpuertoorigen" name="añadirpuertoorigen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Escribe el puerto de origen" required="">
                </div>




                <!-- {/* Puerto destino */} -->
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Puerto destino:</label>
                    <input type="text" id="añadirpuertodestino" name="añadirpuertodestino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5" placeholder="Escribe el puerto de destino" required="" />
                </div>

            </div>

            <button type="submit" class="text-white bg-slate-600 hover:bg-slate-700 font-medium rounded-xl text-sm w-full sm:w-auto px-5 py-2.5 text-center">Añadir</button>
        </form>
    </div>
</body>

</html>