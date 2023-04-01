<?php
// Se llama a la conexion
include("conexion.php");

// Se llama a la sesion del usuario
session_start();

// Verifica si el usuario esta logueado, si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a buscador
$verificarlogueo = $_SESSION['Usuariologin'];
if ($verificarlogueo == null || $verificarlogueo = "") {
    header("location: login.php");
    die();
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

    <title>Inicio</title>
</head>

<body>

    <!-- {/* Botón menú - Sidebar */} -->
    <div class="flex justify-center border-t border-b border-gray-200 lg:hidden py-2">
        <button data-collapse-toggle="mobile-menu-1" type="button" aria-controls="mobile-menu-1" aria-expanded="false" class="flex justify-center">
            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="self-center">
                Menú
            </span>
        </button>
    </div>

    <div class="flex">
        <!-- {/* Sidebar */} -->
        <div class="lg:block absolute z-10 lg:fixed lg:top-22">
            <?php include 'componentes/sidebar.php'; ?>
        </div>
        <!-- {/* Contenido */} -->
        <div class="p-1 lg:p-6 font-bold z-0 w-screen h-screen lg:ml-64">
            <div class="rounded-xl mx-6 lg:mr-0 uppercase mt-4 lg:mt-0 items-stretch">
                <form action="" method="post">
                    <div class="flex w-full">
                        <label for="campo" class="self-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 drop-shadow">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </label>
                        <input type="text" placeholder="Buscador" name="campo" id="campo" class="w-full p-2 bg-white rounded-xl">
                    </div>
                </form>
            </div>

            <div class="rounded-xl m-6 lg:mr-0">
                <div class="overflow-x-auto relative shadow sm:rounded-xl">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-slate-200 text-center">
                            <tr>
                                <th scope="col" class="py-3 px-6">Código inventario</th>
                                <th scope="col" class="py-3 px-6">Marca</th>
                                <th scope="col" class="py-3 px-6">RFC</th>
                                <th scope="col" class="py-3 px-6">Modelo</th>
                                <th scope="col" class="py-3 px-6"></th>
                            </tr>
                        </thead>
                        <!-- El id del cuerpo de la tabla. -->
                        <tbody id="content" class="text-center bg-white">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</body>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script>
    /* Llamando a la función getData() */
    getData()
    /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
    document.getElementById("campo").addEventListener("keyup", getData)
    /* Peticion AJAX */
    function getData() {
        let input = document.getElementById("campo").value
        let content = document.getElementById("content")
        let url = "load.php"
        let formaData = new FormData()
        formaData.append('campo', input)
        fetch(url, {
                method: "POST",
                body: formaData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }
</script>

</html>