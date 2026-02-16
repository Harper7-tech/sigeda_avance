<?php
// config/config.php
// ------------------------------------------------------
// Archivo de configuración de la conexión a la BD MySQL
// Módulo: Configuración general
// Avance: 1 - Conexión y base para autenticación
// ------------------------------------------------------

// Parámetros de conexión al servidor MySQL (XAMPP)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "sigeda";

// Crear el objeto de conexión usando mysqli
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar si hubo errores al conectar
if ($conexion->connect_errno) {
    // Si hay error, se detiene la ejecución mostrando el mensaje
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas con tildes/ñ
$conexion->set_charset("utf8mb4");
?>
