<?php
session_start();
require_once 'connection.php'; // Inclua seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Receber os dados do formulário
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Consulta SQL para verificar o login
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // Login correto
            header("Location: displayProductsFront.php");
        } else {
            // Login incorreto
            echo "Login incorreto. Verifique suas credenciais.";
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }

    $db->close();
}
?>