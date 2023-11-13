<?php
require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se os campos obrigatórios foram enviados
    if (isset($_POST['idProduct'], $_POST['name'], $_POST['price'], $_POST['category'], $_POST['active'])) {
        $idProduct = $_POST['idProduct'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $active = ($_POST['active'] == 'true') ? 1 : 0; // Converte o valor "true" ou "false" para 1 ou 0

        // Verifique se os dados são válidos (adicione mais validações conforme necessário)
        if (!empty($idProduct) && !empty($name) && is_numeric($price) && !empty($category) && is_numeric($active)) {

            // Atualize os dados no banco de dados
            $query = "UPDATE Products SET nameProduct=?, price=?, categoryName=?, active=? WHERE idProduct=?";
            $stmt = $db->prepare($query);

            // Verifique se a preparação da consulta foi bem-sucedida
            if ($stmt) {
                // Atualize a string de tipos de dados para incluir o tipo do idProduct
                $stmt->bind_param("ssssi", $name, $price, $category, $active, $idProduct);

                if ($stmt->execute()) {

                    echo '<script>
                            alert("Produto alterado com sucesso!");
                        </script>';

                    // Aguarde 3 segundos antes de redirecionar
                    header("refresh:1;url=DisplayProductsFront.php");
                    exit(); // Certifique-se de sair para evitar execução adicional do código
                } else {
                    echo "Erro na execução da consulta: " . $stmt->error; // Pode retornar uma mensagem de erro
                }

                $stmt->close();
            } else {
                echo "Erro na preparação da consulta: " . $db->error;
            }
        } else {
            echo "Dados inválidos enviados.";
        }
    } else {
        echo "Campos obrigatórios não foram fornecidos.";
    }
} else {
    echo "Método de requisição inválido.";
}

$db->close();
?>