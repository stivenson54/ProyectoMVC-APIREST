<?php

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/controllers/ProductoController.php";

// Crear conexión
$database = new Database();
$db = $database->conectar();

// Crear controlador
$controller = new ProductoController($db);

// Obtener productos
$productos = $controller->index();

// Cargar la vista
require_once __DIR__ . "/views/productos/index.php";
?>
