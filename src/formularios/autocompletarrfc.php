<!-- Este archivo es parte de la función autocompletar input "Personal asignado (RFC)" donde se muestra el RFC de la base de datos del sii -->
<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'sii_prueba');

$connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

$html = '';
$keyrfc = $_POST['key'];

$result = $connexion->query(
    'SELECT * FROM prueba 
    WHERE 1 
    AND Nombre LIKE "%'.strip_tags($keyrfc).'%"
    ORDER BY Nombre DESC LIMIT 0,5'
);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a class="suggest-elementrfc cursor-pointer" data="'.utf8_encode($row['RFC']).'" id="Prueba'.$row['idPrueba'].'">'.utf8_encode($row['RFC']).' '.utf8_encode($row['Nombre']).'</a></div>';
    }
}
echo $html;
?>