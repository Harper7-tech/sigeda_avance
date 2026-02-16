<?php
include("../config/config.php");

// Genera reporte simple de documentos
$sql = "SELECT COUNT(*) as total FROM documentos";
$resultado = $conn->query($sql);
$fila = $resultado->fetch_assoc();

echo "Total de documentos registrados: " . $fila['total'];
?>