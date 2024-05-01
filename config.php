<?php

// Arquivo de configuração do banco de dados
$hostname = "localhost";
$username = "root";
$password = "aula123";
$database = "loja_online";

// Conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verificação de erros na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>