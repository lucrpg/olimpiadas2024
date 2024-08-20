<?php
include '../includes/db_connect.php';
session_start();

$user_id = $_SESSION['user_id'];
$pedido_id = $_GET['pedido_id'];

$sql = "UPDATE Pago SET Estado_Pago = 'Pagado', Fecha_Pago = NOW() WHERE ID_Pedido = $pedido_id";
$conn->query($sql);

header("Location: history.php");
?>
