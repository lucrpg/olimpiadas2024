<?php
include '../includes/db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];
$cantidad = 1;

$sql_pedido = "SELECT * FROM Pedido WHERE ID_Cliente = $user_id AND Estado_Pedido = 'Pendiente'";
$result_pedido = $conn->query($sql_pedido);

if ($result_pedido->num_rows == 0) {
    $sql_create_pedido = "INSERT INTO Pedido (ID_Cliente, Fecha_Pedido, Estado_Pedido) VALUES ($user_id, NOW(), 'Pendiente')";
    $conn->query($sql_create_pedido);
    $pedido_id = $conn->insert_id;
} else {
    $row_pedido = $result_pedido->fetch_assoc();
    $pedido_id = $row_pedido['ID_Pedido'];
}

$sql_producto = "SELECT * FROM Producto WHERE ID_Producto = $product_id";
$result_producto = $conn->query($sql_producto);
$row_producto = $result_producto->fetch_assoc();
$precio_unitario = $row_producto['Precio'];
$subtotal = $precio_unitario * $cantidad;

$sql_add_detalle = "INSERT INTO Detalle_Pedido (ID_Pedido, ID_Producto, Cantidad, Precio_Unitario, Subtotal) VALUES ($pedido_id, $product_id, $cantidad, $precio_unitario, $subtotal)";
$conn->query($sql_add_detalle);

header("Location: view.php");
?>
