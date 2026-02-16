<?php
// public/documentos_buscar.php
// ------------------------------------------------------
// Módulo: Búsqueda avanzada de documentos
// Funcionalidad: Filtra documentos por título, categoría y rango de fechas.
// Avance: 3
// ------------------------------------------------------

require_once "../includes/auth_check.php";
require_once "../config/config.php";
require_once "../includes/header.php";

// Obtener categorías para el combo
$categorias = $conexion->query("SELECT id, nombre FROM categorias ORDER BY nombre ASC");

// Recuperar filtros desde GET (para poder compartir la URL)
$titulo = trim($_GET["titulo"] ?? "");
$categoria_id = $_GET["categoria_id"] ?? "";
$fecha_desde = $_GET["fecha_desde"] ?? "";
$fecha_hasta = $_GET["fecha_hasta"] ?? "";

// Construcción dinámica del WHERE
$condiciones = [];
if ($titulo !== "") {
    // Se usa LIKE con escape básico
    $titulo_escapado = $conexion->real_escape_string($titulo);
    $condiciones[] = "d.titulo LIKE '%{$titulo_escapado}%'";
}

if ($categoria_id !== "" && ctype_digit($categoria_id)) {
    $condiciones[] = "d.categoria_id = " . intval($categoria_id);
}

if ($fecha_desde !== "" && $fecha_hasta !== "") {
    // Validación simple de formato (YYYY-MM-DD)
    $condiciones[] = "DATE(d.fecha_subida) BETWEEN '{$fecha_desde}' AND '{$fecha_hasta}'";
} elseif ($fecha_desde !== "") {
    $condiciones[] = "DATE(d.fecha_subida) >= '{$fecha_desde}'";
} elseif ($fecha_hasta !== "") {
    $condiciones[] = "DATE(d.fecha_subida) <= '{$fecha_hasta}'";
}

$where = "";
if (count($condiciones) > 0) {
    $where = "WHERE " . implode(" AND ", $condiciones);
}

// Consulta final
$sql = "
    SELECT d.*, c.nombre AS categoria
    FROM documentos d
    JOIN categorias c ON d.categoria_id = c.id
    {$where}
    ORDER BY d.fecha_subida DESC
";

$resultado = $conexion->query($sql);
?>

<h2>Búsqueda de Documentos</h2>

<form method="get" action="documentos_buscar.php">
    <div class="form-control">
        <label for="titulo">Título contiene:</label>
        <input type="text" name="titulo" id="titulo"
               value="<?php echo htmlspecialchars($titulo); ?>">
    </div>

    <div class="form-control">
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" id="categoria_id">
            <option value="">(Todas)</option>
            <?php while ($c = $categorias->fetch_assoc()): ?>
                <option value="<?php echo $c["id"]; ?>"
                    <?php if ($categoria_id !== "" && $categoria_id == $c["id"]) echo "selected"; ?>>
                    <?php echo htmlspecialchars($c["nombre"]); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-control">
        <label>Rango de fechas (fecha de subida):</label>
        <input type="date" name="fecha_desde" value="<?php echo htmlspecialchars($fecha_desde); ?>">
        <input type="date" name="fecha_hasta" value="<?php echo htmlspecialchars($fecha_hasta); ?>">
    </div>

    <input type="submit" value="Buscar documentos">
</form>

<?php
// Contador de resultados
$total = $resultado ? $resultado->num_rows : 0;
?>
<p><strong>Resultados encontrados: <?php echo $total; ?></strong></p>

<?php if ($total > 0): ?>
    <!-- Enlace al reporte imprimible usando los mismos filtros -->
    <p>
        <a href="documentos_reporte.php?<?php echo http_build_query($_GET); ?>" target="_blank">
            Ver reporte imprimible
        </a>
    </p>

    <table border="1" cellpadding="6">
        <tr>
            <th>Título</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Fecha de subida</th>
            <th>Archivo</th>
        </tr>
        <?php while ($d = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($d["titulo"]); ?></td>
                <td><?php echo htmlspecialchars($d["categoria"]); ?></td>
                <td><?php echo htmlspecialchars($d["descripcion"]); ?></td>
                <td><?php echo htmlspecialchars($d["fecha_subida"]); ?></td>
                <td>
                    <a href="../uploads/<?php echo htmlspecialchars($d["nombre_archivo"]); ?>" download>
                        Descargar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No se encontraron documentos con los criterios especificados.</p>
<?php endif; ?>

<?php
require_once "../includes/footer.php";
?>
