<?php
require_once 'Connection.php';

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['active'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $active = ($_POST['active'] == 'true') ? 1 : 0; // Converte o valor "true" ou "false" para 1 ou 0

    // Atualize os dados no banco de dados
    $query = "UPDATE Products SET nameProduct=?, price=?, categoryName=?, active=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssss", $name, $price, $category, $active);
    
    if ($stmt->execute()) {
        echo "Atualização bem-sucedida"; // Pode retornar uma mensagem de sucesso
        echo '<script>';
        echo 'alert("Atualização bem-sucedida");';
        echo 'window.location = "sua_pagina.php";'; // Redireciona para a página desejada
        echo '</script>';
    } else {
        echo "Erro na atualização"; // Pode retornar uma mensagem de erro
    }

    $stmt->close();
}

$db->close();
?>
