<?php
//session_start();

// Tenta conectar ao banco de dados local
$hostname = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "deia"; 
$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error) {
    // Se a conexão com o banco de dados local falhar, tente conectar ao servidor
    $DB_HOST = $_ENV["DB_HOST"];
    $DB_USER = $_ENV["DB_USER"];
    $DB_PASSWORD = $_ENV["DB_PASSWORD"];
    $DB_NAME = $_ENV["DB_NAME"];
    $DB_PORT = $_ENV["DB_PORT"];

    $db = new mysqli("host=$DB_HOST dbname=$DB_NAME user=$DB_USER password=$DB_PASSWORD port=$DB_PORT");

    if (!$db) {
        die("Falha na conexão com o banco de dados local e com o servidor: ");
    }
}

// Agora você tem uma conexão ativa, seja com o banco de dados local ou com o servidor.
?>