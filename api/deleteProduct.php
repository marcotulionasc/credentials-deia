<?php
require_once 'connection.php'; // Inclua seu arquivo de conexão com o banco de dados aqui

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'idProduct' foi enviado via POST
    if (isset($_POST['idProduct'])) {
        $idProduct = $_POST['idProduct'];

        // Evita injeção de SQL usando prepared statements
        $query = "DELETE FROM Products WHERE idProduct = ?";
        $stmt = $db->prepare($query);

        // Vincula o valor do ID do produto ao statement
        $stmt->bind_param("i", $idProduct);

        // Executa a exclusão
        if ($stmt->execute()) {
            // Redireciona para o index.html após a exclusão bem-sucedida
            header('Location: index.html');
            exit; // Certifique-se de sair do script após o redirecionamento
        } else {
            echo "Erro ao excluir o produto.";
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "ID do Produto não fornecido.";
    }
}

// Fecha a conexão com o banco de dados
$db->close();
?>
