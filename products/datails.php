<?php
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    echo "Error: Producto no especificado.";
    exit();
}

$product_id = $_GET['id'];

// Verifica que la consulta se ejecute correctamente
$sql = "SELECT * FROM Producto WHERE ID_Producto = $product_id";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error en la consulta SQL: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>" . $row['Descripción'] . "</h2>";
    echo "<p>Precio: $" . $row['Precio'] . "</p>";
    echo "<a href='../cart/add.php?id=" . $row['ID_Producto'] . "'>Añadir al carrito</a>";
} else {
    echo "Producto no encontrado.";
}
?>
