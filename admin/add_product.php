<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_producto = $_POST['codigo_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO Producto (Código_Producto, Descripción, Precio, Stock_Disponible) VALUES ('$codigo_producto', '$descripcion', '$precio', '$stock')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto añadido exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST">
    <input type="text" name="codigo_producto" placeholder="Código de Producto" required>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <input type="number" name="stock" placeholder="Stock Disponible" required>
    <button type="submit">Añadir Producto</button>
</form>
