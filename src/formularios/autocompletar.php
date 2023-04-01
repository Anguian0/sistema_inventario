<!-- Este archivo es parte de la función autocompletar input "conectado a" donde se muestra el Numero_inventario de la tabla recursos -->
<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'gri_prueba');

$connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

$html = '';
$key = $_POST['key'];

$result = $connexion->query(
    'SELECT * FROM recursos 
    WHERE 1 
    AND Numero_inventario LIKE "%'.strip_tags($key).'%"
    ORDER BY Numero_inventario DESC LIMIT 0,5'
);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a class="suggest-element cursor-pointer" data="'.utf8_encode($row['Numero_inventario']).'" id="Recurso'.$row['idRecurso'].'">'.utf8_encode($row['Numero_inventario']).'</a></div>';
    }
}
echo $html;
?>