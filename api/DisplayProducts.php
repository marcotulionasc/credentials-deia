<?php
require_once 'connection.php';

$query = "SELECT * FROM Products WHERE active=1";
$result = $db->query($query);

if ($result) {

    echo '<thead>';
    echo '<tr>';
    echo '<th>Produto</th>';
    echo '<th>Categoria</th>';
    echo '<th>Preço de custo</th>';
    echo '<th>Preço de venda</th>';
    echo '<th>Porcentagem de lucro</th>';
    echo '<th>Ativo</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        // Calcula a porcentagem de lucro (30%)
        $precoVenda = $row['price'];
        $porcentagemLucro = 30; // 30% de lucro, você pode ajustar conforme necessário
        $precoCusto = $precoVenda / (1 + ($porcentagemLucro / 100));

        // Arrendondei os dois por que vai que ela insere no Front-end os centavos com 3 casas
        $precoCusto = number_format($precoCusto, 2);
        $precoVenda = number_format($precoVenda, 2);

        // Converte o valor de "active" para "ativo" ou "inativo"
        $status = ($row['active'] == 1) ? 'ativo' : 'inativo';

        echo '<tr>';
        echo '<td>' . $row['nameProduct'] . '</td>';
        echo '<td>' . $row['categoryName'] . '</td>';
        echo '<td>' . $precoCusto . '</td>';
        echo '<td>' . $precoVenda . '</td>';
        echo '<td>' . $porcentagemLucro . '%' . '</td>';
        echo '<td>' . $status . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
}

$db->close();
?>
