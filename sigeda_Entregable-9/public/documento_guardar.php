<?php
require_once "../includes/auth_check.php";
require_once "../config/config.php";

$titulo = trim($_POST["titulo"]);
$descripcion = trim($_POST["descripcion"]);
$categoria_id = $_POST["categoria_id"];
$usuario_id = $_SESSION["usuario_id"];

$carpeta = "../uploads/";

if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

$archivo = $_FILES["archivo"];
$nombre_original = $archivo["name"];
$ruta_temporal = $archivo["tmp_name"];
$extension = pathinfo($nombre_original, PATHINFO_EXTENSION);

// Validaciones básicas
$permitidos = ["pdf", "docx", "jpg", "png"];

if (!in_array(strtolower($extension), $permitidos)) {
    die("Formato no permitido.");
}

// Nuevo nombre único
$nombre_archivo = time() . "_" . basename($nombre_original);
$ruta_destino = $carpeta . $nombre_archivo;

if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
    $sql = "INSERT INTO documentos (titulo, descripcion, nombre_archivo, categoria_id, usuario_id)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssii", $titulo, $descripcion, $nombre_archivo, $categoria_id, $usuario_id);
    $stmt->execute();

    header("Location: documentos.php?msg=ok");
} else {
    echo "Error al subir archivo.";
}
?>
