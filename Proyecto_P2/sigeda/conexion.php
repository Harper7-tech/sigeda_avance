<?php
// Datos de configuracion del servidor de base de datos
$host = "localhost";     // Servidor donde se encuentra MySQL (localhost = PC)
$user = "root";          // Usuario de la base de datos
$password = "";          // Contraseña del usuario (vacía por defecto en XAMPP)
$db = "sigeda_db";       // Nombre de la base de datos que usa el sistema

// Crear la conexion a MySQL usando la clase mysqli
$conn = new mysqli($host, $user, $password, $db);

// Verificar si hubo un error en la conexion
if ($conn->connect_error) {
    // Si falla, se detiene el sistema y muestra el error
    die("Error de conexion: " . $conn->connect_error);
}

// Si no entra al if, significa que la conexion fue exitosa
?>