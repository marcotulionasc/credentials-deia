$(document).ready(function() {
    // Defina a função para a solicitação AJAX
    function fetchProducts() {
        $.ajax({
            url: "api/DisplayProducts.php",
            method: "GET",
            success: function(response) {
                $("#dataProducts").html(response);
            },
            error: function() {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    }

    // Chame a função para disparar a solicitação AJAX
    fetchProducts();
});