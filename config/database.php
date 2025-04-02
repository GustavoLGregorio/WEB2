<?php

$host = 'localhost';
$dbname = 'pdv';
$username = 'gustavo';
$password = 'Gustavo@678';

try {
    // Criando a conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    // Captura erro e exibe mensagem
    die("Erro na conexão: " . $erro->getMessage());
}