<?php
header('Content-Type: application/json; charset=utf-8');
function responder(int $status, array $dados): void {
    http_response_code($status);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}
function metodo(string $esperado): void {
    if ($_SERVER['REQUEST_METHOD'] !== $esperado) {
        header('Allow: ' . $esperado);
        responder(405, ['sucesso' => false, 'mensagem' => 'Método não permitido.']);
    }
}
function campo(string $nome, int $maximo, bool $obrigatorio = true): string {
    $valor = $_POST[$nome] ?? '';
    if (!is_string($valor)) responder(400, ['sucesso'=>false,'mensagem'=>'Campo inválido: '.$nome]);
    $valor = trim($valor);
    if (($obrigatorio && $valor === '') || strlen($valor) > $maximo * 4 || preg_match('//u', $valor) !== 1 || preg_match_all('/./us', $valor) > $maximo) {
        responder(400, ['sucesso'=>false,'mensagem'=>'Verifique o campo: '.$nome]);
    }
    return $valor;
}
function emailValido(string $email): void {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) responder(400,['sucesso'=>false,'mensagem'=>'Informe um e-mail válido.']);
}
function erroBanco(Throwable $e): void {
    error_log($e->getMessage());
    responder(500, ['sucesso'=>false,'mensagem'=>'Não foi possível acessar o banco de dados.']);
}
