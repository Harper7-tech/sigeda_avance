<?php
// public/login.php
// ------------------------------------------------------
// Formulario de inicio de sesión y validación de credenciales.
// Módulo: Usuarios y Autenticación
// Funcionalidad: Iniciar sesión en el sistema.
// Avance: 1
// ------------------------------------------------------

// Iniciar sesión para poder guardar datos del usuario si el login es correcto
session_start();

// Incluir la configuración de la base de datos
require_once "../config/config.php";

// Variable para almacenar mensajes de error (si los hay)
$mensaje_error = "";

// Verificar si el formulario fue enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recuperar datos del formulario de manera segura
    $correo = trim($_POST["correo"] ?? "");
    $contrasena = trim($_POST["contrasena"] ?? "");

    // Validación básica de campos vacíos
    if ($correo === "" || $contrasena === "") {
        $mensaje_error = "Por favor, ingrese su correo y contraseña.";
    } else {
        // Preparar la consulta para buscar el usuario por correo
        $sql = "SELECT id, nombre_completo, correo, contrasena, rol 
                FROM usuarios 
                WHERE correo = ? AND estado = 1
                LIMIT 1";
        
        // Preparar la sentencia para evitar inyección SQL
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar el parámetro (s = string)
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();

            // Verificar si se encontró un usuario
            if ($resultado && $resultado->num_rows === 1) {
                $usuario = $resultado->fetch_assoc();

                // Comparar contraseña (texto simple en este avance)
                if ($contrasena === $usuario["contrasena"]) {
                    // Credenciales correctas → guardar datos en la sesión
                    $_SESSION["usuario_id"] = $usuario["id"];
                    $_SESSION["nombre_completo"] = $usuario["nombre_completo"];
                    $_SESSION["rol"] = $usuario["rol"];

                    // Redirigir a la página principal
                    header("Location: index.php");
                    exit;
                } else {
                    $mensaje_error = "Contraseña incorrecta.";
                }
            } else {
                // No se encontró ningún usuario con ese correo
                $mensaje_error = "Usuario no encontrado o inactivo.";
            }

            $stmt->close();
        } else {
            $mensaje_error = "Error al preparar la consulta.";
        }
    }
}

// Incluir cabecera HTML
require_once "../includes/header.php";
?>

<h2>Inicio de sesión</h2>

<?php if ($mensaje_error !== ""): ?>
    <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <div class="form-control">
        <label for="correo">Correo electrónico:</label>
        <input type="text" name="correo" id="correo" placeholder="admin@sigeda.local">
    </div>
    <div class="form-control">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
    </div>
    <input type="submit" value="Ingresar">
</form>

<?php
// Incluir pie de página HTML
require_once "../includes/footer.php";
?>
