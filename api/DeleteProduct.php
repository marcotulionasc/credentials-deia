<?php
require_once 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'id' foi enviado via POST
    if (isset($_POST['id'])) {
        $idProduct = $_POST['id'];

        // Evita injeção de SQL usando prepared statements
        $query = "DELETE FROM Products WHERE idProduct = ?";
        $stmt = $db->prepare($query);

        // Vincula o valor do ID do produto ao statement
        $stmt->bind_param("i", $idProduct);

        // Executa a exclusão
        if ($stmt->execute()) {
            // Retorna uma resposta de sucesso
            header('Location: ../displayProducts.html');
            exit; // Certifique-se de sair do script após o redirecionamento
        } else {
            // Retorna uma resposta de erro
            echo "error";
        }

        // Fecha o statement
        $stmt->close();
    } else {
        // Retorna uma mensagem de erro se o ID não foi fornecido
        echo "ID do Produto não fornecido.";
    }
} else {
    // Retorna uma mensagem de erro se a solicitação não for do tipo POST
    echo "Método de solicitação inválido.";
}

// Fecha a conexão com o banco de dados
$db->close();
?>
