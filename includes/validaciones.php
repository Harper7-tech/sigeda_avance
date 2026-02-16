<?php
// -----------------------------------------------------------
// Archivo: validaciones.php
// Propósito: Centralizar validaciones comunes del sistema SiGeDA
// Autor: Equipo de desarrollo
// Avance: 2
// -----------------------------------------------------------


// Validar texto no vacío
function validarTexto($campo, $min = 1, $max = 255) {
    $campo = trim($campo);

    if ($campo === "") {
        return "El campo no puede estar vacío.";
    }

    if (strlen($campo) < $min) {
        return "El texto debe tener al menos {$min} caracteres.";
    }

    if (strlen($campo) > $max) {
        return "El texto supera el límite de {$max} caracteres.";
    }

    return true;
}


// Validar archivo (subida de documentos)
function validarArchivo($archivo, $permitidos = ["pdf","docx","jpg","png"], $maxMB = 5) {

    if ($archivo["error"] !== UPLOAD_ERR_OK) {
        return "No se pudo cargar el archivo.";
    }

    // Obtener extensión
    $extension = strtolower(pathinfo($archivo["name"], PATHINFO_EXTENSION));

    if (!in_array($extension, $permitidos)) {
        return "El formato de archivo '{$extension}' no está permitido.";
    }

    // Tamaño en MB
    $tamMB = $archivo["size"] / (1024 * 1024);

    if ($tamMB > $maxMB) {
        return "El archivo supera el tamaño máximo permitido de {$maxMB} MB.";
    }

    return true;
}


// Validar identificación de categoría
function validarCategoriaID($id) {
    if (!ctype_digit("$id") || intval($id) <= 0) {
        return "Categoría seleccionada inválida.";
    }
    return true;
}

?>
