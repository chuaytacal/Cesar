<?php
require_once __DIR__ . '/../helpers.php';

function getAllClima() {
    $url = "https://wttr.in/Tacna?format=j1";
    $response = @file_get_contents($url);

    if (!$response) {
        sendJson(["error" => "No se pudo obtener el clima"], 500);
    }

    $data = json_decode($response, true);
    $clima = [
        "ciudad" => $data["nearest_area"][0]["areaName"][0]["value"],
        "temperatura" => $data["current_condition"][0]["temp_C"] . "°C",
        "descripcion" => $data["current_condition"][0]["lang_es"][0]["value"]
    ];
    sendJson($clima);
}
