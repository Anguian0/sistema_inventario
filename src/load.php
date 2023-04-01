<?php
// Este archivo es parte del proceso del buscarador.php

// Se llama a la conexion
require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['idRecurso', 'Numero_inventario', 'Marca', 'RFC', 'Modelo'];

/* Nombre de la tabla */
$table = "recursos";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where ";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['Numero_inventario'] . '</td>';
        $html .= '<td>' . $row['Marca'] . '</td>';
        $html .= '<td>' . $row['RFC'] . '</td>';
        $html .= '<td>' . $row['Modelo'] . '</td>';
        $html .= '<td><a href="recurso.php?url=' . $row['idRecurso'] . '">Ver</a></td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);