<?php
// Verifica si el usuario tiene sesion activa
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>