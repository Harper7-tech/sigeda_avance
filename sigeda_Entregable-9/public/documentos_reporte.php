<?php
// public/documentos_reporte.php
// ------------------------------------------------------
// Módulo: Reporte imprimible de documentos
// Usa los mismos filtros que documentos_buscar.php
// Avance: 3
// ------------------------------------------------------

require_once "../includes/auth_check.php";
require_once "../config/config.php";

// Recuperar filtros (igual que en documentos_buscar.php)
$titulo = trim($_GET["titulo"] ?? "");
$categoria_id = $_GET["categoria_id"] ?? "";
$fecha_desde = $_GET["fecha_desde"] ?? "";
$fecha_hasta = $_GET["fecha_hasta"] ?? "";

$condiciones = [];
if ($titulo !== "") {
    $titulo_escapado = $conexion->real_escape_string($titulo);
    $condiciones[] = "d.titulo LIKE '%{$titulo_escapado}%'";
}
if ($categoria_id !== "" && ctype_digit($categoria_id)) {
    $condiciones[] = "d.categoria_id = " . intval($categoria_id);
}
if ($fecha_desde !== "" && $fecha_hasta !== "") {
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

$sql = "
    SELECT d.*, c.nombre AS categoria
    FROM documentos d
    JOIN categorias c ON d.categoria_id = c.id
    {$where}
    ORDER BY d.fecha_subida DESC
";
$resultado = $conexion->query($sql);
$total = $resultado ? $resultado->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Documentos - SiGeDA</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 4px; }
        th { background-color: #eee; }
        .info { margin-top: 10px; }
        .filtros { font-size: 11px; }
    </style>
</head>
<body onload="window.print();">
    <h1>Reporte de Documentos - SiGeDA</h1>
    <div class="info">
        <p>Total de documentos: <strong><?php echo $total; ?></strong></p>
        <p class="filtros">
            Filtros aplicados:
            <?php
            $descFiltros = [];
            if ($titulo !== "") $descFiltros[] = "Título contiene '{$titulo}'";
            if ($categoria_id !== "") $descFiltros[] = "Categoría ID {$categoria_id}";
            if ($fecha_desde !== "") $descFiltros[] = "Desde {$fecha_desde}";
            if ($fecha_hasta !== "") $descFiltros[] = "Hasta {$fecha_hasta}";
            echo (count($descFiltros) > 0) ? implode(" | ", $descFiltros) : "Ninguno";
            ?>
        </p>
    </div>

    <table>
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
                <td><?php echo htmlspecialchars($d["nombre_archivo"]); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
