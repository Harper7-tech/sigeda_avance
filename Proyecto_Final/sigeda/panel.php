<?php
// Inicia la sesion para poder acceder a los datos del usuario
session_start();

// Verifica si el usuario ha iniciado sesion
// Si no existe la variable de sesion, lo redirige al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit(); // Detiene la ejecucion del script
}
?>

<h2>Panel Principal - SiGeDA</h2>

<!-- Muestra el nombre del usuario que inicio sesion -->
<p>Bienvenido, <?php echo $_SESSION['usuario']; ?></p>

<ul>
    <!-- Enlaces a los modulos principales del sistema -->
    <li><a href="subir.php">Subir documento</a></li>
    <li><a href="documentos.php">Ver documentos</a></li>
    <li><a href="logout.php">Cerrar sesión</a></li>
</ul>
