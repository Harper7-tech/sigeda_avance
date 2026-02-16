<?php
// Incluye la conexion a la base de datos
include("conexion.php");
?>

<h2>Subir Documento</h2>

<!-- Formulario para cargar un archivo al servidor -->
<form method="POST" enctype="multipart/form-data">
    Titulo: <input type="text" name="titulo" required><br><br>
    Descripcion: <textarea name="descripcion"></textarea><br><br>
    Archivo: <input type="file" name="archivo" required><br><br>
    <button type="submit">Subir</button>
</form>

<?php
// Verifica si el formulario fue enviado
if ($_POST) {

    // Datos ingresados por el usuario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    // Nombre del archivo subido
    $nombreArchivo = $_FILES['archivo']['name'];

    // Ruta donde se guardara el archivo en el servidor
    $ruta = "uploads/" . $nombreArchivo;

    // Mueve el archivo temporal a la carpeta uploads
    move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

    // Guarda la informacion del documento en la base de datos
    $sql = "INSERT INTO documentos (titulo, descripcion, archivo) 
            VALUES ('$titulo', '$descripcion', '$nombreArchivo')";

    // Verifica si el registro se guardo correctamente
    if ($conn->query($sql)) {
        echo "<p style='color:green;'>Documento subido correctamente</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
