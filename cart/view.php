<?php
include '../includes/db_connect.php';
session_start();

// Evitar caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Verificar si la sesión está activa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Si se ha enviado una solicitud de eliminación
if (isset($_POST['remove_id'])) {
    $detalle_id = $_POST['remove_id'];
    $sql_remove = "DELETE FROM Detalle_Pedido WHERE ID_Detalle = $detalle_id";
    if ($conn->query($sql_remove) === TRUE) {
        // Recargar la página después de eliminar el producto
        header("Location: view.php"); // Esto recarga la misma página
        exit;
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

$user_id = $_SESSION['user_id'];

// Obtener el pedido pendiente del usuario
$sql_pedido = "SELECT * FROM Pedido WHERE ID_Cliente = $user_id AND Estado_Pedido = 'Pendiente'";
$result_pedido = $conn->query($sql_pedido);

if ($result_pedido->num_rows > 0) {
    $row_pedido = $result_pedido->fetch_assoc();
    $pedido_id = $row_pedido['ID_Pedido'];

    // Obtener los detalles del pedido
    $sql_detalle = "SELECT Detalle_Pedido.*, Producto.Descripción, Producto.Precio 
                    FROM Detalle_Pedido 
                    JOIN Producto ON Detalle_Pedido.ID_Producto = Producto.ID_Producto 
                    WHERE Detalle_Pedido.ID_Pedido = $pedido_id";
    $result_detalle = $conn->query($sql_detalle);

    if ($result_detalle->num_rows > 0) {
        $total = 0;
        echo "<h2>Tu Carrito</h2>";
        while ($row_detalle = $result_detalle->fetch_assoc()) {
            $subtotal = $row_detalle['Cantidad'] * $row_detalle['Precio'];
            $total += $subtotal;
            echo "<div>";
            echo "<h3>" . $row_detalle['Descripción'] . "</h3>";
            echo "<p>Cantidad: " . $row_detalle['Cantidad'] . "</p>";
            echo "<p>Subtotal: $" . number_format($subtotal, 2) . "</p>";
            echo "<form method='POST' style='display:inline;'>
                    <input type='hidden' name='remove_id' value='" . $row_detalle['ID_Detalle'] . "'>
                    <button type='submit'>Eliminar</button>
                  </form>";
            echo "</div><hr>";
        }
        echo "<h3>Total: $" . number_format($total, 2) . "</h3>";
        echo "<a href='../orders/checkout.php'>Proceder al pago</a>";
    } else {
        echo "<p>Tu carrito está vacío</p>";
    }
} else {
    echo "<p>No tienes un pedido pendiente.</p>";
}
?>
