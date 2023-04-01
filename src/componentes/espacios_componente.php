<!-- Se hace una consulta de 2 tablas, tabla Areas y Espacios. -->
<?php
$url = $_GET["url"];

$datos = mysqli_query($conexion, "SELECT t1.idArea, t1.NombreArea, t2.idEspacio, t2.NombreEspacio, t2.Area_id FROM areas t1 INNER JOIN espacios t2 ON t1.idArea = t2.Area_id WHERE idArea = '$url'");

while ($consulta = mysqli_fetch_array($datos)) {
?>

    <!-- En esta parte se muestra el título -->
    <div>
        <h1 class="text-center rounded-xl bg-slate-300 text-xl p-2 px-6 mx-6 lg:mr-0 uppercase mt-4 lg:mt-0">Espacios del <?php echo $consulta['NombreArea']; ?></h1>
    </div>

    <!-- Sección donde se muestran los espacios -->
    <div class="bg-slate-300 rounded-xl m-6 lg:mr-0 lg:p-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
        <!-- Se hace otra consulta de 2 tablas, Areas y Espacios pero aqui se agregan más columnas. -->
        <?php
        $url = $_GET["url"];

        $datos = mysqli_query($conexion, "SELECT t1.idArea, t1.NombreArea, t2.idEspacio, t2.NombreEspacio, t2.Planta, t2.Area_id FROM areas t1 INNER JOIN espacios t2 ON t1.idArea = t2.Area_id WHERE idArea = '$url'");

        while ($consulta = mysqli_fetch_array($datos)) {
        ?>
            <a href="../src/equipos.php?url=<?php echo $consulta['idEspacio']; ?>" class="bg-gray-100 rounded-xl grid place-items-center cursor-pointer">
                <p class="py-3 text-lg"><?php echo $consulta['NombreEspacio']; ?></p>
                <p class="bg-gray-200 w-full text-center py-1 rounded-b-xl text-gray-500">Planta: <?php echo $consulta['Planta']; ?></p>
            </a>
        <?php
        }
        ?>
    </div>

<?php
}
?>