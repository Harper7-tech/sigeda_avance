<?php
require_once "../includes/auth_check.php";
require_once "../includes/header.php";
require_once "../config/config.php";

$mensaje = "";

// Guardar categoría nueva
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if ($nombre !== "") {
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $nombre, $descripcion);
        $stmt->execute();
        $mensaje = "Categoría registrada correctamente.";
    } else {
        $mensaje = "Debe ingresar un nombre de categoría.";
    }
}

// Obtener categorías existentes
$categorias = $conexion->query("SELECT * FROM categorias ORDER BY id DESC");
?>

<h2>Gestión de Categorías</h2>

<?php if ($mensaje !== ""): ?>
    <p class="mensaje-exito"><?php echo $mensaje; ?></p>
<?php endif; ?>

<form method="post">
    <div class="form-control">
        <label>Nombre de categoría</label>
        <input type="text" name="nombre">
    </div>

    <div class="form-control">
        <label>Descripción</label>
        <input type="text" name="descripcion">
    </div>

    <input type="submit" value="Guardar">
</form>

<h3>Categorías registradas</h3>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha</th>
    </tr>

    <?php while ($c = $categorias->fetch_assoc()): ?>
    <tr>
        <td><?php echo $c["id"]; ?></td>
        <td><?php echo $c["nombre"]; ?></td>
        <td><?php echo $c["descripcion"]; ?></td>
        <td><?php echo $c["fecha_creacion"]; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php require_once "../includes/footer.php"; ?>
