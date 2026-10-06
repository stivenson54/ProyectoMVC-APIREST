<?php

require_once __DIR__ . "/../models/Producto.php";

class ProductoController
{
    private $producto;

    public function __construct($db)
    {
        $this->producto = new Producto($db);
    }

    // Listar todos los productos
    public function index()
    {
        return $this->producto->listar();
    }

    // Obtener un producto por ID
    public function show($id)
    {
        return $this->producto->obtener($id);
    }

    // Crear un producto
    public function store($datos)
    {
        $this->producto->nombre = trim($datos["nombre"] ?? "");
        $this->producto->descripcion = trim($datos["descripcion"] ?? "");
        $this->producto->precio = $datos["precio"] ?? 0;
        $this->producto->stock = $datos["stock"] ?? 0;

        return $this->producto->crear();
    }

    // Actualizar un producto
    public function update($datos)
    {
        $this->producto->id = $datos["id"] ?? 0;
        $this->producto->nombre = trim($datos["nombre"] ?? "");
        $this->producto->descripcion = trim($datos["descripcion"] ?? "");
        $this->producto->precio = $datos["precio"] ?? 0;
        $this->producto->stock = $datos["stock"] ?? 0;

        return $this->producto->actualizar();
    }

    // Eliminar un producto
    public function delete($id)
    {
        $this->producto->id = $id;

        return $this->producto->eliminar();
    }
}
?>