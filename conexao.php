<?php

$host = "infinityfree.com";
$usuario = "usuario";
$senha = "password"
$banco = " ";

$conexao = new mysqli(
    $host,
    $usuario,
    $senha,
    $banco
);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");

?>
