<?php
session_start();
require_once 'connection.php'; // Inclua seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $token = $_POST['token'];

    // Consulta SQL para verificar as credenciais do usuário, incluindo o campo "token"
    $query = "SELECT idAdmin, password, token FROM admin WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password']) && $token === $row['token']) {
            // Autenticação bem-sucedida
            $_SESSION['admin_id'] = $row['idAdmin'];
            header("Location: index.php");
            exit;
        } else {
            header("Location: index.php");
            echo $email;
            echo "<br>";
            echo $password;
            echo "<br>";
            echo $token;
            echo "<br>";
            echo "Credenciais inválidas.";
        }
    } else {
        echo "Email não encontrado.";
    }

    $stmt->close();
}
?>
