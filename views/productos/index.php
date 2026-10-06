<?php
if (!isset($productos)) {
    $productos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de productos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #222;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .vacio {
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>Gestión de productos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($productos)): ?>

                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto["id"]) ?></td>
                        <td><?= htmlspecialchars($producto["nombre"]) ?></td>
                        <td><?= htmlspecialchars($producto["descripcion"] ?? "") ?></td>
                        <td>$<?= number_format((float) $producto["precio"], 2, ",", ".") ?></td>
                        <td><?= htmlspecialchars($producto["stock"]) ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5" class="vacio">
                        No hay productos registrados.
                    </td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
