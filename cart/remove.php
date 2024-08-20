<?php
include '../includes/db_connect.php';
session_start();

$id_detalle = $_GET['id'];

$sql = "DELETE FROM Detalle_Pedido WHERE ID_Detalle = $id_detalle";
$conn->query($sql);

header("Location: view.php");
exit();
?>
