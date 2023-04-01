<!-- Consulta para mostrar datos de los espacios -->
<?php
$url = $_GET["url"];

$datos = mysqli_query($conexion, "SELECT * FROM espacios WHERE idEspacio = '$url'");

while ($consulta = mysqli_fetch_array($datos)) {
?>
    <!-- Aquí va el título -->
    <div>
        <h1 class="text-center rounded-xl bg-slate-300 text-xl p-2 px-6 mx-6 lg:mr-0 uppercase mt-4 lg:mt-0">Equipos de <?php echo $consulta['NombreEspacio']; ?></h1>
    </div>
<?php
}
?>




<!-- Botones. Se hace consulta de la cantidad de registros de los equipos -->
<div class="my-6 font-mono text-xl grid grid-cols-2 lg:grid-cols-5 gap-5 mx-6 lg:mx-0 lg:ml-6 text-center">
    <?php
    $url = $_GET["url"];

    $obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 1");

    while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
    ?>
        <a href="#pc" class="font-mono py-1.5 px-3 border border-gray-600 text-gray-600 rounded-xl bg-gray-50">PC - (<?php echo $consultac['total']; ?>)</a>
        <?php
    }
        ?><?php
    $url = $_GET["url"];

    $obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 2");

    while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
    ?>
        <a href="#laptop" class="font-mono py-1.5 px-3 border border-gray-600 text-gray-600 rounded-xl bg-gray-50">Laptop - (<?php echo $consultac['total']; ?>)</a>
        <?php
    }
        ?><?php
    $url = $_GET["url"];

    $obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 3");

    while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
    ?>
        <a href="#impresora" class="font-mono py-1.5 px-3 border border-gray-600 text-gray-600 rounded-xl bg-gray-50">Impresora - (<?php echo $consultac['total']; ?>)</a>
        <?php
    }
        ?><?php
    $url = $_GET["url"];

    $obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 4");

    while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
    ?>
        <a href="#switch" class="font-mono py-1.5 px-3 border border-gray-600 text-gray-600 rounded-xl bg-gray-50">Switch - (<?php echo $consultac['total']; ?>)</a>
        <?php
    }
        ?><?php
    $url = $_GET["url"];

    $obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 5");

    while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
    ?>
        <a href="#router" class="font-mono py-1.5 px-3 border border-gray-600 text-gray-600 rounded-xl bg-gray-50">Router - (<?php echo $consultac['total']; ?>)</a>
    <?php
    }
    ?>
</div>







<!-- Muestra los equipos por tipo de equipo, muestra tambien la cantidad de registros. -->
<!-- Aquí se muestran las PC -->
<?php
$url = $_GET["url"];

$obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 1");

while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
?>
    <h2 id="pc" class="mx-12 mt-6 mb-3 font-mono text-xl">PC - (<?php echo $consultac['total']; ?>)</h2>
<?php
}
?>

<div class="bg-slate-300 rounded-xl m-6 mt-0 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
    <?php
    $url = $_GET["url"];

    $datosrecursos = mysqli_query($conexion, "SELECT * FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 1");

    while ($consultarecurso = mysqli_fetch_array($datosrecursos)) {
    ?>
        <a href="../src/recurso.php?url=<?php echo $consultarecurso['idRecurso']; ?>" class="bg-gray-100 
         rounded-xl grid place-items-center cursor-pointer">
            <img src="../src/img/<?php echo $consultarecurso['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="h-36 w-full cover rounded-t-xl">

            <p class="py-3">Inventario: <?php echo $consultarecurso['Numero_inventario']; ?></p>
        </a>
    <?php
    }
    ?>
</div>



<!-- Aquí se muestran las Laptop -->
<?php
$url = $_GET["url"];

$obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 2");

while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
?>
    <h2 id="laptop" class="mx-12 mt-6 mb-3 font-mono text-xl">Laptop - (<?php echo $consultac['total']; ?>)</h2>
<?php
}
?>
<div class="bg-slate-300 rounded-xl m-6 mt-0 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
    <?php
    $url = $_GET["url"];

    $datosrecursos = mysqli_query($conexion, "SELECT * FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 2");

    while ($consultarecurso = mysqli_fetch_array($datosrecursos)) {
    ?>
        <a href="../src/recurso.php?url=<?php echo $consultarecurso['idRecurso']; ?>" class="bg-gray-100 
         rounded-xl grid place-items-center cursor-pointer">
            <img src="../src/img/<?php echo $consultarecurso['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="h-36 w-full cover rounded-t-xl">

            <p class="py-3">Inventario: <?php echo $consultarecurso['Numero_inventario']; ?></p>
        </a>
    <?php
    }
    ?>
</div>



<!-- Aquí se muestran las Impresoras -->
<?php
$url = $_GET["url"];

$obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 3");

while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
?>
    <h2 id="impresora" class="mx-12 mt-6 mb-3 font-mono text-xl">Impresora - (<?php echo $consultac['total']; ?>)</h2>
<?php
}
?>
<div class="bg-slate-300 rounded-xl m-6 mt-0 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
    <?php
    $url = $_GET["url"];

    $datosrecursos = mysqli_query($conexion, "SELECT * FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 3");

    while ($consultarecurso = mysqli_fetch_array($datosrecursos)) {
    ?>
        <a href="../src/recurso.php?url=<?php echo $consultarecurso['idRecurso']; ?>" class="bg-gray-100 
         rounded-xl grid place-items-center cursor-pointer">
            <img src="../src/img/<?php echo $consultarecurso['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="h-36 w-full cover rounded-t-xl">

            <p class="py-3">Inventario: <?php echo $consultarecurso['Numero_inventario']; ?></p>
        </a>
    <?php
    }
    ?>
</div>



<!-- Aquí se muestran los Switch -->
<?php
$url = $_GET["url"];

$obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 4");

while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
?>
    <h2 id="switch" class="mx-12 mt-6 mb-3 font-mono text-xl">Switch - (<?php echo $consultac['total']; ?>)</h2>
<?php
}
?>
<div class="bg-slate-300 rounded-xl m-6 mt-0 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
    <?php
    $url = $_GET["url"];

    $datosrecursos = mysqli_query($conexion, "SELECT * FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 4");

    while ($consultarecurso = mysqli_fetch_array($datosrecursos)) {
    ?>
        <a href="../src/recurso.php?url=<?php echo $consultarecurso['idRecurso']; ?>" class="bg-gray-100 
         rounded-xl grid place-items-center cursor-pointer">
            <img src="../src/img/<?php echo $consultarecurso['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="h-36 w-full cover rounded-t-xl">

            <p class="py-3">Inventario: <?php echo $consultarecurso['Numero_inventario']; ?></p>
        </a>
    <?php
    }
    ?>
</div>



<!-- Aquí se muestran los Routers -->
<?php
$url = $_GET["url"];

$obtenerdatosc = mysqli_query($conexion, "SELECT count(Tipo_equipo_id) AS total FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 5");

while ($consultac = mysqli_fetch_array($obtenerdatosc)) {
?>
    <h2 id="router" class="mx-12 mt-6 mb-3 font-mono text-xl">Router - (<?php echo $consultac['total']; ?>)</h2>
<?php
}
?>
<div class="bg-slate-300 rounded-xl m-6 mt-0 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4 mb-0">
    <?php
    $url = $_GET["url"];

    $datosrecursos = mysqli_query($conexion, "SELECT * FROM recursos WHERE Espacio_id = '$url' AND Tipo_equipo_id = 5");

    while ($consultarecurso = mysqli_fetch_array($datosrecursos)) {
    ?>
        <a href="../src/recurso.php?url=<?php echo $consultarecurso['idRecurso']; ?>" class="bg-gray-100 
         rounded-xl grid place-items-center cursor-pointer">
            <img src="../src/img/<?php echo $consultarecurso['Tipo_equipo_id']; ?>.webp" alt="imagenrecurso" class="h-36 w-full cover rounded-t-xl">

            <p class="py-3">Inventario: <?php echo $consultarecurso['Numero_inventario']; ?></p>
        </a>
    <?php
    }
    ?>
</div><br>