<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco_venda = $_POST['preco_venda'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    // Processar a imagem
    if ($_FILES['imagem']['error'] === 0) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        echo "Erro ao carregar a imagem.";
        exit;
    }

    // Evitar injeção de SQL usando prepared statements
    $stmt = $db->prepare("INSERT INTO Products (nameProduct, categoryName, price, active, image) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssdis", $nome, $categoria, $preco_venda, $ativo, $imagem);
        $result = $stmt->execute();

        if ($result) {
            echo "Produto inserido com sucesso!";
            $stmt->close();

            // Redirecionar para a página index.html após a inserção bem-sucedida
            header("Location: index.html");
            exit;
        } else {
            echo "Erro ao inserir o produto.";
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta.";
    }
}

$db->close();
?>
