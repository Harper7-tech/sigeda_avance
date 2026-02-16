<?php
// public/index.php
// ------------------------------------------------------
// Página de inicio del sistema (dashboard sencillo).
// Requiere que el usuario haya iniciado sesión.
// Módulo: Usuarios y Autenticación
// Avance: 1
// ------------------------------------------------------

// Incluir verificación de sesión
require_once "../includes/auth_check.php";

// Incluir cabecera HTML
require_once "../includes/header.php";
?>

<h2>Panel principal de SiGeDA</h2>
<p>
    Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["nombre_completo"]); ?></strong>.
</p>
<p>
    Este es el panel principal. En avances posteriores se agregarán:
</p>
<ul>
    <li>Módulo de carga y almacenamiento de documentos.</li>
    <li>Módulo de clasificación, búsqueda y filtros.</li>
    <li>Módulo de descarga y reportes.</li>
</ul>

<?php
// Incluir pie de página HTML
require_once "../includes/footer.php";
?>
