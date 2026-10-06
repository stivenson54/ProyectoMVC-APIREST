<?php

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Producto.php";

$database = new Database();
$db = $database->conectar();

$producto = new Producto($db);

$metodo = $_SERVER["REQUEST_METHOD"];

/*
|--------------------------------------------------------------------------
| GET - Listar productos
|--------------------------------------------------------------------------
*/

if ($metodo === "GET") {

    $stmt = $producto->listar();

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(
        $productos,
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );

    exit;
}

/*
|--------------------------------------------------------------------------
| POST - Crear producto
|--------------------------------------------------------------------------
*/

if ($metodo === "POST") {

    $datos = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($datos["nombre"]) ||
        !isset($datos["descripcion"]) ||
        !isset($datos["precio"]) ||
        !isset($datos["stock"])
    ) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Faltan datos del producto"
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $producto->nombre = $datos["nombre"];
    $producto->descripcion = $datos["descripcion"];
    $producto->precio = $datos["precio"];
    $producto->stock = $datos["stock"];

    if ($producto->crear()) {

        http_response_code(201);

        echo json_encode([
            "mensaje" => "Producto creado correctamente"
        ], JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(500);

        echo json_encode([
            "mensaje" => "No se pudo crear el producto"
        ], JSON_UNESCAPED_UNICODE);
    }

    exit;
}

/*
|--------------------------------------------------------------------------
| PUT - Actualizar producto
|--------------------------------------------------------------------------
*/

if ($metodo === "PUT") {

    $datos = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($datos["id"]) ||
        !isset($datos["nombre"]) ||
        !isset($datos["descripcion"]) ||
        !isset($datos["precio"]) ||
        !isset($datos["stock"])
    ) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Faltan datos para actualizar el producto"
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $producto->id = $datos["id"];
    $producto->nombre = $datos["nombre"];
    $producto->descripcion = $datos["descripcion"];
    $producto->precio = $datos["precio"];
    $producto->stock = $datos["stock"];

    if ($producto->actualizar()) {

        echo json_encode([
            "mensaje" => "Producto actualizado correctamente"
        ], JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(500);

        echo json_encode([
            "mensaje" => "No se pudo actualizar el producto"
        ], JSON_UNESCAPED_UNICODE);
    }

    exit;
}

/*
|--------------------------------------------------------------------------
| DELETE - Eliminar producto
|--------------------------------------------------------------------------
*/

if ($metodo === "DELETE") {

    $datos = json_decode(file_get_contents("php://input"), true);

    if (!isset($datos["id"])) {

        http_response_code(400);

        echo json_encode([
            "mensaje" => "Debe indicar el ID del producto"
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $producto->id = $datos["id"];

    if ($producto->eliminar()) {

        echo json_encode([
            "mensaje" => "Producto eliminado correctamente"
        ], JSON_UNESCAPED_UNICODE);

    } else {

        http_response_code(500);

        echo json_encode([
            "mensaje" => "No se pudo eliminar el producto"
        ], JSON_UNESCAPED_UNICODE);
    }

    exit;
}

/*
|--------------------------------------------------------------------------
| Método no permitido
|--------------------------------------------------------------------------
*/

http_response_code(405);

echo json_encode([
    "mensaje" => "Método HTTP no permitido"
], JSON_UNESCAPED_UNICODE);

?>