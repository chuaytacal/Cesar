<?php
function getJsonInput() {
    $data = json_decode(file_get_contents("php://input"), true);
    return $data ?: [];
}

function sendJson($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function notFound($message = "Recurso no encontrado") {
    sendJson(["error" => $message], 404);
}

function badRequest($message = "Solicitud inválida") {
    sendJson(["error" => $message], 400);
}
