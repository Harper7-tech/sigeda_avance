<?php
// public/logout.php
// ------------------------------------------------------
// Cierra la sesión del usuario y lo redirige al login.
// Módulo: Usuarios y Autenticación
// Avance: 1
// ------------------------------------------------------

// Iniciar o reanudar sesión
session_start();

// Vaciar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión en el servidor
session_destroy();

// Redirigir a la página de login
header("Location: login.php");
exit;
