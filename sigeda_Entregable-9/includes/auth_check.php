<?php
// includes/auth_check.php
// ------------------------------------------------------
// Verifica si el usuario ha iniciado sesión.
// Si no hay sesión activa, redirige a login.php.
// Módulo: Usuarios y Autenticación
// Avance: 1
// ------------------------------------------------------

// Iniciar o reanudar la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no existe el índice 'usuario_id', se asume que no hay sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
