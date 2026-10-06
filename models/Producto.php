<?php

class Producto
{
    private $conn;
    private $tabla = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Listar todos los productos
    public function listar()
    {
        $sql = "SELECT * FROM " . $this->tabla;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    // Obtener un producto por su ID
    public function obtener($id)
    {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear producto
    public function crear()
    {
        $sql = "INSERT INTO " . $this->tabla . "
                (nombre, descripcion, precio, stock)
                VALUES
                (:nombre, :descripcion, :precio, :stock)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);

        return $stmt->execute();
    }

    // Actualizar producto
    public function actualizar()
    {
        $sql = "UPDATE " . $this->tabla . "
                SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    stock = :stock
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Eliminar producto
    public function eliminar()
    {
        $sql = "DELETE FROM " . $this->tabla . "
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Obtener todos los productos para reportes
    public function obtenerTodos()
    {
        $sql = "SELECT * FROM " . $this->tabla;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>