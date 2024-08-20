<?php
include '../includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Cliente WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Contraseña'])) {
            $_SESSION['user_id'] = $row['ID_Cliente'];
            header("Location: ../products/list.php");
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No se encontró un usuario con ese email";
    }
}
?>

<form method="POST"><br>
    <h2>inicia sesion</h2>
    <h4>completa los campos</h4>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Iniciar Sesión</button>
</form>
