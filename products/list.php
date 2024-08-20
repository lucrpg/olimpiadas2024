<?php

include '../includes/db_connect.php';
session_start();

$sql = "SELECT * FROM Producto";
$result = $conn->query($sql);

include '../includes/header.php'; 

 // Asegúrate de que la ruta sea correcta

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['Descripción'] . "</h2>";
        echo "<p>Precio: $" . $row['Precio'] . "</p>";
        echo "<a href='../cart/add.php?id=" . $row['ID_Producto'] . "'>Añadir al carrito</a>";
        echo "</div>";
    }
} else {
    echo "No hay productos disponibles";
}

include '../includes/footer.php';
?>
