<?php
require 'resposta.php';
require 'conexao.php';
metodo('GET');
try {
    $con = conectar();
    $stmt = $con->query('SELECT id,nome,descricao,imagem,imagem_alt,pagina,preco FROM servicos ORDER BY id');
    responder(200,['sucesso'=>true,'servicos'=>$stmt->fetchAll()]);
} catch (PDOException $e) { erroBanco($e); }
