<?php
// Manejo de subida de archivos
$archivo = $_FILES['archivo']['name'];
$ruta = "../uploads/" . $archivo;

if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta)) {
    echo "Archivo subido correctamente";
} else {
    echo "Error al subir archivo";
}
?>