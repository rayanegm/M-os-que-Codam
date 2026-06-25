<?php

$host = "sql210.infinityfree.com";
$usuario = "if0_42064994";
$senha = "HeLena456";
$banco = "if0_42064994_maosquecodam";

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