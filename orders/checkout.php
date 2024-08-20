<?php
include '../includes/db_connect.php';
session_start();

$user_id = $_SESSION['user_id'];
$sql_pedido = "SELECT * FROM Pedido WHERE ID_Cliente = $user_id AND Estado_Pedido = 'Pendiente'";
$result_pedido = $conn->query($sql_pedido);

if ($result_pedido->num_rows > 0) {
    $row_pedido = $result_pedido->fetch_assoc();
    $pedido_id = $row_pedido['ID_Pedido'];

    $sql_update_pedido = "UPDATE Pedido SET Estado_Pedido = 'Confirmado', Total = (SELECT SUM(Subtotal) FROM Detalle_Pedido WHERE ID_Pedido = $pedido_id) WHERE ID_Pedido = $pedido_id";
    $conn->query($sql_update_pedido);

    echo "Tu pedido ha sido confirmado. Procede al pago.";
} else {
    echo "No hay pedido pendiente.";
}
?>
