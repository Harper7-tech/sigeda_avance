<?php
require_once "../includes/auth_check.php";
require_once "../includes/header.php";
require_once "../config/config.php";

$docs = $conexion->query("
    SELECT d.*, c.nombre AS categoria
    FROM documentos d
    JOIN categorias c ON d.categoria_id = c.id
    ORDER BY d.id DESC
");

if (isset($_GET["msg"]) && $_GET["msg"] === "ok"):
    echo "<p class='mensaje-exito'>Documento subido correctamente.</p>";
endif;
?>

<h2>Lista de Documentos</h2>

<table border="1" cellpadding="6">
<tr>
    <th>Título</th>
    <th>Categoría</th>
    <th>Archivo</th>
    <th>Fecha</th>
</tr>

<?php while ($d = $docs->fetch_assoc()): ?>
<tr>
    <td><?php echo $d["titulo"]; ?></td>
    <td><?php echo $d["categoria"]; ?></td>
    <td><a href="../uploads/<?php echo $d["nombre_archivo"]; ?>" download>Descargar</a></td>
    <td><?php echo $d["fecha_subida"]; ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php require_once "../includes/footer.php"; ?>

<?php
// ... arriba sigue igual que tu documentos.php actual ...

$docs = $conexion->query("
    SELECT d.*, c.nombre AS categoria
    FROM documentos d
    JOIN categorias c ON d.categoria_id = c.id
    ORDER BY d.id DESC
");
$total = $docs ? $docs->num_rows : 0;
?>

<h2>Lista de Documentos</h2>

<p>Total de documentos almacenados: <strong><?php echo $total; ?></strong></p>
<p>
    <a href="documentos_buscar.php">Ir a búsqueda avanzada</a>
</p>

<table border="1" cellpadding="6">
    <!-- resto igual -->
</table>

<?php require_once "../includes/footer.php"; ?>
