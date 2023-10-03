<?php
session_start();
require_once 'connection.php'; // Inclua seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Consulta SQL para verificar o email do usuário
    $query = "SELECT idAdmin FROM admin WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['idAdmin'];
        header("Location: ../displayProducts.html");
        exit;
    } else {
        echo "Email não encontrado.";
    }

    $stmt->close();
}
?>
