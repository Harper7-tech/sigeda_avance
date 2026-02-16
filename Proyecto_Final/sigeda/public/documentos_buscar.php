<?php
include("../config/config.php");

// Buscar documentos por titulo
$buscar = $_GET['buscar'];

$sql = "SELECT * FROM documentos WHERE titulo LIKE '%$buscar%'";
$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo $fila['titulo'] . " - " . $fila['descripcion'] . "<br>";
}
?>