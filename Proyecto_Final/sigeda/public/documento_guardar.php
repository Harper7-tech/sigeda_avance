<?php
include("../config/config.php");
include("../includes/validaciones.php");

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];

if (validarTexto($titulo) && validarTexto($descripcion)) {
    $sql = "INSERT INTO documentos (titulo, descripcion, categoria)
            VALUES ('$titulo', '$descripcion', '$categoria')";
    $conn->query($sql);
    echo "Documento guardado";
} else {
    echo "Datos invalidos";
}
?>