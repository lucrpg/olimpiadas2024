<?php
include 'includes/db_connect.php';
session_start();

// Si se ha enviado la solicitud de cierre de sesión
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Deportes al Aire Libre</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

   <header>
        <div class="header-container">
            <div class="logo">
                <img src="/images/logo.png" alt="Logo de la Tienda">
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="products/list.php">Productos</a></li>
                    <li><a href="cart/view.php">Carrito</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="#" onclick="document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="user/login.php">Iniciar Sesión</a></li>
                        <li><a href="user/register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Formulario oculto para cerrar sesión -->
    <form id="logout-form" method="POST" style="display: none;">
        <input type="hidden" name="logout" value="1">
    </form>

    <!-- Contenido principal -->
    <main>
        <h2>Productos Destacados</h2>
        <div class="productos-destacados">
            <?php
            // Consultar productos en un orden fijo (por ID, por ejemplo)
            $sql = "SELECT * FROM Producto ORDER BY ID_Producto LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='producto'>";
                    echo "<h3>" . $row['Descripción'] . "</h3>";
                    echo "<p>Precio: $" . $row['Precio'] . "</p>";
                    
                    if (isset($_SESSION['user_id'])) {
                        // Si el usuario está registrado, permitir añadir al carrito
                        echo "<a href='cart/add.php?id=" . $row['ID_Producto'] . "'>Añadir al carrito</a>";
                    } else {
                        // Si el usuario no está registrado, mostrar mensaje
                        echo "<a href='user/login.php' onclick='alert(\"Debes iniciar sesión o registrarte para añadir productos al carrito.\"); return false;'>Añadir al carrito</a>";
                    }
                    echo "</div>";
                } 
            } else {
                echo "<p>No hay productos disponibles en este momento.</p>";
            }
            ?>
        </div>
    </main>
    
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Tienda de Deportes al Aire Libre. Todos los derechos reservados.</p>
            <nav class="footer-nav">
                <ul>
                    <li><a href="/about.php">Sobre Nosotros</a></li>
                    <li><a href="/privacy.php">Política de Privacidad</a></li>
                    <li><a href="/contact.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>
</html>
