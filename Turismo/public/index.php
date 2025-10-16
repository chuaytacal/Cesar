<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../src/helpers.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = explode('/', trim($requestPath, '/'));

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$resource = $requestUri[0] ?? null;
$id = $requestUri[1] ?? null;

$controllerFile = __DIR__ . '/../src/controllers/' . $resource . '.php';

if (!$resource || !file_exists($controllerFile)) {
    notFound("Ruta no encontrada: /$resource");
}

require $controllerFile;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            $function = "get" . ucfirst(rtrim($resource, 's'));
            if (function_exists($function)) {
                $function($id);
            } else {
                notFound("Función GET $function no implementada");
            }
        } else {
            $function = "getAll" . ucfirst($resource);
            if (function_exists($function)) {
                $function();
            } else {
                notFound("Función GET $function no implementada");
            }
        }
        break;

    case 'POST':
        $function = "create" . ucfirst(rtrim($resource, 's'));
        if (function_exists($function)) {
            $data = getJsonInput();
            $function($data);
        } else {
            notFound("Función POST $function no implementada");
        }
        break;

    case 'PUT':
    case 'PATCH':
        if (!$id) badRequest("ID requerido para actualizar");
        $function = "update" . ucfirst(rtrim($resource, 's'));
        if (function_exists($function)) {
            $data = getJsonInput();
            $function($id, $data);
        } else {
            notFound("Función PUT $function no implementada");
        }
        break;

    case 'DELETE':
        if (!$id) badRequest("ID requerido para eliminar");
        $function = "delete" . ucfirst(rtrim($resource, 's'));
        if (function_exists($function)) {
            $function($id);
        } else {
            notFound("Función DELETE $function no implementada");
        }
        break;

    default:
        badRequest("Método HTTP no soportado");
}
