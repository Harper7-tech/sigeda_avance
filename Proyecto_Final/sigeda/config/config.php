<?php
// Archivo: config.php
// Proposito: Conexion a la base de datos del sistema SiGeDA

$host = "localhost";
$user = "root";
$pass = "";
$db = "sigeda_db";

// Crear conexion
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexion
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}
?>