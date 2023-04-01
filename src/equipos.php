<?php
// Se llama a la sesion del usuario
session_start();

// Verifica si el usuario esta logueado, si no lo esta lo regresa a login, porque si no esta logueado no dejara que entre a index
$verificarlogueo = $_SESSION['Usuariologin'];
if($verificarlogueo == null || $verificarlogueo = ""){
    header("location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/output.css">
    <title>Tipos de equipos</title>
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
            <?php require 'componentes/sidebar.php'; ?>
        </div>
        <!-- {/* Contenido */} -->
        <div class="p-1 lg:p-6 font-bold z-0 w-screen h-screen lg:ml-64">
            <?php require 'componentes/equipos_componente.php'; ?>
        </div>
    </div>



</body>
<!-- Script para funcionamiento del menú -->
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

</html>