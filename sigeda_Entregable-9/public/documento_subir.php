<?php
require_once "../includes/auth_check.php";
require_once "../includes/header.php";
require_once "../config/config.php";

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre ASC");
?>

<h2>Subir Documento</h2>

<form action="documento_guardar.php" method="post" enctype="multipart/form-data">

    <div class="form-control">
        <label>Título del documento</label>
        <input type="text" name="titulo" required>
    </div>

    <div class="form-control">
        <label>Descripción</label>
        <input type="text" name="descripcion">
    </div>

    <div class="form-control">
        <label>Categoría</label>
        <select name="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            <?php while ($c = $categorias->fetch_assoc()): ?>
                <option value="<?php echo $c["id"]; ?>">
                    <?php echo $c["nombre"]; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-control">
        <label>Archivo (PDF, DOCX, JPG)</label>
        <input type="file" name="archivo" required>
    </div>

    <input type="submit" value="Subir Documento">

</form>

<?php require_once "../includes/footer.php"; ?>
