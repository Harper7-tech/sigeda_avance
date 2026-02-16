-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS sigeda
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

USE sigeda;

-- Tabla de usuarios del sistema
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,  -- En este avance se usará texto simple por simplicidad académica
    rol ENUM('admin', 'usuario') NOT NULL DEFAULT 'admin',
    estado TINYINT(1) NOT NULL DEFAULT 1,  -- 1 = Activo, 0 = Inactivo
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Usuario administrador inicial
INSERT INTO usuarios (nombre_completo, correo, contrasena, rol)
VALUES ('Administrador General', 'admin@sigeda.local', 'admin123', 'admin');
