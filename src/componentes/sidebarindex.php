<!-- Se llama a la conexion -->
<?php
require("src/conexion.php");
?>

<!-- Menú -->
<nav id="mobile-menu-1" class="hidden lg:block">
    <div class="text-center bg-slate-300 p-6 pt-4 w-64 lg:m-6 h-fit rounded-xl text-gray-700">
        <div class="block">
            <div class="flex justify-between items-stretch">
                <h2 class="pb-4 text-lg font-bold">Áreas</h2>
                <a title="Buscar equipo" href="src/buscador.php" class="self-center pb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 drop-shadow">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </a>
            </div>
            <hr class="border-slate-400" />
        </div>

        <div class="pt-2 scrollbar overflow-y-auto h-[503px]">

            <!-- Mostrar datos por una consulta a la tabla Areas -->
            <?php
            $datos = mysqli_query($conexion, "SELECT * FROM `areas` WHERE 1");

            while ($consulta = mysqli_fetch_array($datos)) {
            ?>

                <!-- Botón del area -->
                <a href="src/espacios.php?url=<?php echo $consulta['idArea']; ?>" class="my-4 py-2 w-full rounded-xl bg-gray-100 flex justify-evenly">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>
                        <?php echo $consulta['NombreArea']; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>

            <?php
            }
            ?>
        </div>

        <!-- Sección del botón inferior -->
        <div class="mt-4 rounded-xl py-2 flex justify-evenly items-stretch bg-gray-100">
            <a title="Dashboard" href="src/dashboard.php" class="self-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block h-7  w-7 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
            <a title="Dashboard" href="src/dashboard.php" class="self-center">
                <!-- Aquí muestra el nombre de usuario del usuario que esté logueado -->
                <p class="self-center px-2"><?php echo $_SESSION['Usuariologin']; ?></p>
            </a>
            <a title="Cerrar sesión" href="src/cerrar_sesion.php" class="self-center">
                <svg class="w-6 h-6 self-center" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </a>
        </div>
    </div>
</nav>