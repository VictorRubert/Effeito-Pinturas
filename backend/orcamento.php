<?php
require 'resposta.php';
require 'conexao.php';
metodo('POST');
$servico = filter_var($_POST['servico_id'] ?? '', FILTER_VALIDATE_INT);
$nome = campo('nome',150);
$email = campo('email',200);
$telefone = campo('telefone',30);
$data = campo('data_desejada',10);
$endereco = campo('endereco',250);
$cidade = campo('cidade',100);
$uf = strtoupper(campo('uf',2));
$obs = campo('observacoes',3000,false);
emailValido($email);
$dia = DateTime::createFromFormat('!Y-m-d', $data);
if (!$servico || !$dia || $dia->format('Y-m-d') !== $data || !preg_match('/^[A-Z]{2}$/', $uf)) {
    responder(400,['sucesso'=>false,'mensagem'=>'Verifique o serviço, a data e a UF.']);
}
try {
    $con = conectar();
    $consulta = $con->prepare('SELECT id FROM servicos WHERE id = ?');
    $consulta->execute([$servico]);
    if (!$consulta->fetch()) responder(400,['sucesso'=>false,'mensagem'=>'Serviço inexistente.']);
    $sql = 'INSERT INTO orcamentos (servico_id,nome,email,telefone,data_desejada,endereco,cidade,uf,observacoes) VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $con->prepare($sql);
    $stmt->execute([$servico,$nome,$email,$telefone,$data,$endereco,$cidade,$uf,$obs]);
    responder(201,['sucesso'=>true,'mensagem'=>'Solicitação enviada com sucesso!']);
} catch (PDOException $e) { erroBanco($e); }
