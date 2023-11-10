<?php
require_once 'Connection.php';

if (isset($_POST['idProduct']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['active'])) {
    $idProduct = $_POST['idProduct'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $active = ($_POST['active'] == 'true') ? 1 : 0; // Converte o valor "true" ou "false" para 1 ou 0

    // Atualize os dados no banco de dados
    $query = "UPDATE Products SET nameProduct=?, price=?, categoryName=?, active=? WHERE idProduct=?";
    $stmt = $db->prepare($query);

// Atualize a string de tipos de dados para incluir o tipo do idProduct
    $stmt->bind_param("ssssi", $name, $price, $category, $active, $idProduct);
    
    if ($stmt->execute()) {
        echo "Atualização bem-sucedida"; // Pode retornar uma mensagem de sucesso
    } else {
        echo "Erro na atualização"; // Pode retornar uma mensagem de erro
    }

    $stmt->close();
}

$db->close();
?>
