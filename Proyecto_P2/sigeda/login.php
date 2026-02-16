<?php
// Muestra errores (solo para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicia la sesion para guardar datos del usuario
session_start();

// Incluye la conexion a la base de datos
include("conexion.php");

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Datos ingresados por el usuario
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    // Consulta para validar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
    $res = $conn->query($sql);

    // Si existe el usuario, se crea la sesion
    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $_SESSION["usuario"] = $user["nombre"];
        $_SESSION["rol"] = $user["rol"];

        echo "Login correcto. Bienvenido " . $user["nombre"];
    } else {
        echo "Correo o password incorrectos";
    }
}
?>

<h2>Login SiGeDA</h2>

<form method="POST">
    Correo: <input type="email" name="correo" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Ingresar</button>
</form>