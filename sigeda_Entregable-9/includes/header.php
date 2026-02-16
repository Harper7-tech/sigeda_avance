<?php
// includes/header.php
// ------------------------------------------------------
// Plantilla de cabecera HTML reutilizable
// Incluye el inicio del documento, título y menú básico.
// ------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SiGeDA - Sistema de Gestión de Documentos Administrativos</title>
    <!-- Estilos básicos (en avances posteriores se puede separar a un CSS) -->
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        header { background-color: #003366; color: #fff; padding: 10px 20px; }
        header h1 { margin: 0; font-size: 20px; }
        nav a {
            color: #fff; margin-right: 15px; text-decoration: none; font-weight: bold;
        }
        main { padding: 20px; }
        .contenedor { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        .mensaje-error { color: red; }
        .mensaje-exito { color: green; }
        .form-control { margin-bottom: 10px; }
        label { display:block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 8px; box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #003366; color: #fff; padding: 8px 16px; border: none; cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0055aa;
        }
    </style>
</head>
<body>
<header>
    <h1>SiGeDA - Gestión de Documentos Administrativos</h1>
    <nav>
        <!-- Menú simple. En avances posteriores se mostrarán opciones según el rol -->
        <a href="/sigeda/public/index.php">Inicio</a>
        <a href="/sigeda/public/logout.php">Cerrar sesión</a>
    </nav>
</header>
<main>
<div class="contenedor">
