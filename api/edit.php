<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduct = $_POST['idProduct'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco_venda = $_POST['preco_venda'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    // Processar a nova imagem, se fornecida
    if ($_FILES['imagem']['error'] === 0) {
        $nova_imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $atualizar_imagem = true;
    } else {
        $atualizar_imagem = false;
    }

    // Verifique se o produto com o ID especificado existe
    $consulta_existente = $db->prepare("SELECT * FROM Products WHERE idProduct = ?");
    $consulta_existente->bind_param("i", $idProduct);
    $consulta_existente->execute();
    $resultado_existente = $consulta_existente->get_result();
    $consulta_existente->close();

    if ($resultado_existente->num_rows > 0) {
        // O produto existe, atualize-o
        $atualizar_query = "UPDATE Products SET nameProduct = ?, categoryName = ?, price = ?, active = ?";
        if ($atualizar_imagem) {
            $atualizar_query .= ", image = ?";
        }
        $atualizar_query .= " WHERE idProduct = ?";

        $stmt = $db->prepare($atualizar_query);
        $stmt->bind_param("ssdii", $nome, $categoria, $preco_venda, $ativo, $idProduct);
        if ($atualizar_imagem) {
            $stmt->send_long_data(4, $nova_imagem); // Enviar nova imagem como dado longo
        }

        if ($stmt->execute()) {
            $stmt->close();

            // Redirecionar para a página de listagem de produtos após a edição bem-sucedida
            header("Location: listar_produtos.php");
            exit;
        } else {
            echo "Erro ao atualizar o produto.";
        }

        $stmt->close();
    } else {
        echo "Produto não encontrado.";
    }
}

$db->close();
?>
