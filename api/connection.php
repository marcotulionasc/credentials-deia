<?php
    $DB_HOST = $_ENV["DB_HOST"];
    $DB_USER = $_ENV["DB_USER"];
    $DB_PASSWORD = $_ENV["DB_PASSWORD"];
    $DB_NAME = $_ENV["DB_NAME"];
    $DB_PORT = $_ENV["DB_PORT"];

    $db = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

    // Verifica a conexão
    if ($db->connect_error) {
        die("Erro na conexão com o banco de dados: " . $db->connect_error);
    }
?>