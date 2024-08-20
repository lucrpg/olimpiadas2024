<?php
include '../includes/db_connect.php';

$sql = "SELECT * FROM Pedido WHERE Estado_Pedido = 'Confirmado'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>Pedido #" . $row['ID_Pedido'] . "</h2>";
        echo "<p>Cliente: " . $row['ID_Cliente'] . "</p>";
        echo "<p>Total: $" . $row['Total'] . "</p>";
        echo "<p>Estado: " . $row['Estado_Pedido'] . "</p>";
        echo "<a href='mark_as_delivered.php?id=" . $row['ID_Pedido'] . "'>Marcar como entregado</a>";
        echo "</div>";
    }
} else {
    echo "No hay pedidos confirmados.";
}
?>
