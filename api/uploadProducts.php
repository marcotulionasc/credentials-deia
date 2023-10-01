<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'connection.phpp';

    if (isset($_POST['productName']) && isset($_POST['productCategory']) && isset($_POST['productDescription']) && isset($_POST['productPrice']) && isset($_FILES['productImage'])) {
        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'];
        $productDescription = $_POST['productDescription'];
        $productPrice = $_POST['productPrice'];
        
        // Informações sobre a imagem
        $image = $_FILES['productImage'];
        $imagePath = "img/" . basename($image['name']);
        
        // Insere os dados no banco de dados
        $query = "INSERT INTO products (title, category, description, price, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $productName, $productCategory, $productDescription, $productPrice, $imagePath);

        if ($stmt->execute()) {
            $productID = $stmt->insert_id;

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $updateQuery = "UPDATE products SET image_path = ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("si", $imagePath, $productID);
                $updateStmt->execute();
                $updateStmt->close();
                
                echo json_encode(array("message" => "Produto inserido com sucesso."));
            } else {
                echo json_encode(array("message" => "Erro ao fazer upload da imagem."));
            }
            
            $stmt->close();
        } else {
            echo json_encode(array("message" => "Erro ao inserir produto."));
        }

        $db->close();
    } else {
        echo json_encode(array("message" => "Todos os campos são obrigatórios."));
    }
} else {
    echo json_encode(array("message" => "Método inválido."));
}
?>
