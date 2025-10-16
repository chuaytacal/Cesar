<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../helpers.php';

$db = Database::getInstance();

function getAllRestaurantes() {
    global $db;
    $stmt = $db->query("SELECT * FROM restaurantes");
    sendJson($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getRestaurante($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM restaurantes WHERE id = ?");
    $stmt->execute([$id]);
    $restaurante = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($restaurante) sendJson($restaurante);
    else notFound("Restaurante no encontrado");
}

function createRestaurante($data) {
    global $db;
    if (empty($data['nombre'])) badRequest("El campo 'nombre' es requerido");
    $stmt = $db->prepare("INSERT INTO restaurantes (nombre, direccion, tipo_comida) VALUES (?, ?, ?)");
    $stmt->execute([
        $data['nombre'],
        $data['direccion'] ?? null,
        $data['tipo_comida'] ?? null
    ]);
    sendJson(["id" => $db->lastInsertId(), "message" => "Restaurante registrado"], 201);
}

function updateRestaurante($id, $data) {
    global $db;
    $stmt = $db->prepare("UPDATE restaurantes SET nombre=?, direccion=?, tipo_comida=? WHERE id=?");
    $stmt->execute([
        $data['nombre'] ?? null,
        $data['direccion'] ?? null,
        $data['tipo_comida'] ?? null,
        $id
    ]);
    sendJson(["message" => "Restaurante actualizado"]);
}

function deleteRestaurante($id) {
    global $db;
    $stmt = $db->prepare("DELETE FROM restaurantes WHERE id = ?");
    $stmt->execute([$id]);
    sendJson(["message" => "Restaurante eliminado"]);
}
