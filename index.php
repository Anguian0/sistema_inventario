<?php
// Llama al archivo donde se hace la conexion a la base de datos
include("src/conexion.php");

// Inicia la sesion del usuario logueado
session_start();

// Verifica si el usuario esta logueado, si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a index
$verificarlogueo = $_SESSION['Usuariologin'];
if($verificarlogueo == null || $verificarlogueo = ""){
    header("location: src/login.php");
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
    <link rel="stylesheet" href="src/css/output.css">
    <title>Inicio</title>
</head>

<body>

    <!-- Botón menú - Sidebar  -->
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
        <!--  Sidebar -->
        <div class="lg:block absolute z-10 lg:fixed lg:top-22">
            <?php include 'src/componentes/sidebarindex.php'; ?>
        </div>
        <!-- Contenido -->
        <div class="p-1 lg:p-6 font-bold z-0 w-screen h-screen lg:ml-64">
            <div class="h-fit lg:ml-6 mt-64">
                <h1 class="underline decoration-gray-700 text-4xl text-gray-700 lg:text-7xl flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
                    BIENVENIDO
                </h1>
            </div>
        </div>
    </div>



</body>
<!-- Script para funcionamiento del menú -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

</html>