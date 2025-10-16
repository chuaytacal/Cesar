<?php
$dbFile = __DIR__ . '/data/db.sqlite';
if (file_exists($dbFile)) {
    unlink($dbFile);
}

$db = new PDO('sqlite:' . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("
CREATE TABLE lugares (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    ubicacion TEXT
);

CREATE TABLE restaurantes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    direccion TEXT,
    tipo_comida TEXT
);
");

$db->exec("
INSERT INTO lugares (nombre, descripcion, ubicacion) VALUES
('Petroglifos de Miculla', 'Sitio arqueológico con petroglifos antiguos', 'Distrito de Pachía'),
('Catedral de Tacna', 'Construcción neoclásica en el centro de Tacna', 'Centro Cívico');

INSERT INTO restaurantes (nombre, direccion, tipo_comida) VALUES
('La Glorieta', 'Av. San Martín 201', 'Comida típica'),
('El Tambo', 'Calle Zela 152', 'Gourmet');
");

echo "Base de datos creada correctamente en data/db.sqlite";
