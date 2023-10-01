<?php
require_once 'connection.php';

$query = "SELECT * FROM Products WHERE active=1";
$result = $db->query($query);

header('Content-type: image/jpg');

if ($result) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        echo '    <div class="product__item">';
        echo '        <div class="product__item__pic set-bg" data-setbg="' . $row['image'] . '">';
        echo '            <img src="img/' . $row['image'] . '" alt="' . $row['nameProduct'] . '">';
        echo '            <div class="product__label">';
        echo '                <span>' . $row['categoryName'] . '</span>';
        echo '            </div>';
        echo '        </div>';
        echo '        <div class="product__item__text">';
        echo '            <h6><a href="#">' . $row['nameProduct'] . '</a></h6>';
        echo '            <div class="product__item__price">$' . $row['price'] . '</div>';
        echo '            <div class="cart_add">';
        echo '                <a href="#">Pedir no Whatsapp!</a>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "Erro na consulta: " . $db->error;
}

$db->close();

?>