$(document).ready(function() {
    // Defina a função para a solicitação AJAX
    function fetchProducts() {
        $.ajax({
            url: "api/Products.php",
            method: "GET",
            success: function(response) {
                $("#dataShop").html(response);
            },
            error: function() {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    }

    // Chame a função para disparar a solicitação AJAX
    fetchProducts();
});