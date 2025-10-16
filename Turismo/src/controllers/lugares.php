<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../helpers.php';

$db = Database::getInstance();

function getAllLugares() {
    global $db;
    $stmt = $db->query("SELECT * FROM lugares");
    sendJson($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getLugare($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM lugares WHERE id = ?");
    $stmt->execute([$id]);
    $lugar = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($lugar) sendJson($lugar);
    else notFound("Lugar no encontrado");
}

function createLugare($data) {
    global $db;
    if (empty($data['nombre'])) badRequest("El campo 'nombre' es requerido");
    $stmt = $db->prepare("INSERT INTO lugares (nombre, descripcion, ubicacion) VALUES (?, ?, ?)");
    $stmt->execute([
        $data['nombre'],
        $data['descripcion'] ?? null,
        $data['ubicacion'] ?? null
    ]);
    sendJson(["id" => $db->lastInsertId(), "message" => "Lugar registrado"], 201);
}

function updateLugare($id, $data) {
    global $db;
    $stmt = $db->prepare("UPDATE lugares SET nombre=?, descripcion=?, ubicacion=? WHERE id=?");
    $stmt->execute([
        $data['nombre'] ?? null,
        $data['descripcion'] ?? null,
        $data['ubicacion'] ?? null,
        $id
    ]);
    sendJson(["message" => "Lugar actualizado"]);
}

function deleteLugare($id) {
    global $db;
    $stmt = $db->prepare("DELETE FROM lugares WHERE id = ?");
    $stmt->execute([$id]);
    sendJson(["message" => "Lugar eliminado"]);
}
