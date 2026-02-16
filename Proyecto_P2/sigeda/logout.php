<?php
// Inicia la sesion actual
session_start();

// Elimina todas las variables de sesion (cierra la sesion del usuario)
session_destroy();

// Redirige al usuario nuevamente al login
header("Location: login.php");
?>