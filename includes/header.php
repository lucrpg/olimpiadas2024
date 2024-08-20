<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Deportes al Aire Libre</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <!-- Cabecera del sitio -->
    <header>
        <div class="header-container">
            <div class="logo">
          
                    <img src="/images/logo.png" alt="Logo de la Tienda">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../products/list.php">Productos</a></li>
                    <li><a href="../cart/view.php">Carrito</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="../user/register.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="../user/login.php">Iniciar Sesión</a></li>
                        <li><a href="../user/register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
