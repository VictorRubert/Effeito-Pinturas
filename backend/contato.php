<?php
require 'resposta.php';
require 'conexao.php';
metodo('POST');
$nome = campo('nome',150);
$email = campo('email',200);
$mensagem = campo('mensagem',3000);
emailValido($email);
try {
    $con = conectar();
    $sql = 'INSERT INTO contatos (nome, email, mensagem) VALUES (?, ?, ?)';
    $stmt = $con->prepare($sql);
    $stmt->execute([$nome, $email, $mensagem]);
    responder(201,['sucesso'=>true,'mensagem'=>'Mensagem enviada! Em breve entraremos em contato.']);
} catch (PDOException $e) { erroBanco($e); }
