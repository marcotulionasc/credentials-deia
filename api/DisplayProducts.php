<?php
require_once 'connection.php';

$query = "SELECT * FROM Products WHERE active=1";
$result = $db->query($query);

if ($result) {
    echo '<div class="card-body">';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
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

        echo '<tr>';
        echo '<td>' . $row['nameProduct'] . '</td>';
        echo '<td>' . $row['categoryName'] . '</td>';
        echo '<td>' . $precoCusto . '</td>';
        echo '<td>' . $precoVenda . '</td>';
        echo '<td>' . $porcentagemLucro . '%' . '</td>';
        echo '<td>' . $row['active'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
}

$db->close();
?>
