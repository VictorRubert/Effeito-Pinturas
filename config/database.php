<?php
// Conexão PDO com o MySQL/MariaDB do XAMPP (igual à organização do BEvolution).
$host = 'localhost';
$banco = 'effeito';
$usuario = 'root';
$senha = '';

try {
    $pdo = new PDO("mysql:host={$host};dbname={$banco};charset=utf8mb4", $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $erro) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco effeito. Crie o banco e suas tabelas no phpMyAdmin e confira config/database.php.');
}
