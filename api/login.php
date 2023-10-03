<?php
session_start();
require_once 'connection.php'; // Inclua seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = $_POST['token'];

    // Consulta SQL para verificar as credenciais do usuário, incluindo o campo "token"
    $query = "SELECT idAdmin, password, token FROM admin WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password']) && $token === $row['token']) {
            // Autenticação bem-sucedida
            $_SESSION['admin_id'] = $row['idAdmin'];
            header("Location: index.php"); // Redirecionar para a página de dashboard após o login
            exit;
        } else {
            echo "Credenciais inválidas.";
        }
    } else {
        echo "Email não encontrado.";
    }

    $stmt->close();
}
?>
