<?php
// Os endpoints usam a mesma conexão PDO da página inicial.
require_once __DIR__ . '/../config/database.php';

function conectar(): PDO {
    global $pdo;
    return $pdo;
}
