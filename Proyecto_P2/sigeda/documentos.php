<?php
// Incluye el archivo de conexion a la base de datos
include("conexion.php");

// Consulta SQL para obtener todos los documentos registrados
$sql = "SELECT * FROM documentos";

// Ejecuta la consulta y guarda el resultado
$res = $conn->query($sql);
?>

<h2>Documentos Subidos</h2>

<!-- Tabla para mostrar los documentos -->
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Titulo</th>
    <th>Descripcion</th>
    <th>Archivo</th>
</tr>

<?php
// Recorre cada fila obtenida de la base de datos
while($row = $res->fetch_assoc()) {
?>
<tr>
    <!-- Muestra el ID del documento -->
    <td><?php echo $row['id']; ?></td>

    <!-- Muestra el titulo del documento -->
    <td><?php echo $row['titulo']; ?></td>

    <!-- Muestra la descripcion del documento -->
    <td><?php echo $row['descripcion']; ?></td>

    <!-- Enlace para abrir o descargar el archivo -->
    <td>
        <a href="uploads/<?php echo $row['archivo']; ?>" target="_blank">
            Ver archivo
        </a>
    </td>
</tr>
<?php
}
?>
</table>