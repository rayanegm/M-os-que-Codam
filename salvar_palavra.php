<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";
include "config_colunas.php";

$palavra = $_POST['palavra'] ?? '';
$video = $_POST['video'] ?? '';
$categoria = $_POST['categoria'] ?? 'Programação';
$nivel = $_POST['nivel'] ?? 'Iniciante';
$resumo = $_POST['resumo'] ?? '';
$descricao_sinal = $_POST['descricao_sinal'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$exemplo_portugues = $_POST['exemplo_portugues'] ?? '';

$sql = "INSERT INTO palavras (palavra, video, categoria, nivel, resumo, descricao_sinal, codigo, exemplo_portugues)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssssss", $palavra, $video, $categoria, $nivel, $resumo, $descricao_sinal, $codigo, $exemplo_portugues);

if ($stmt->execute()) {
    echo "<script>alert('Palavra cadastrada com sucesso!'); window.location.href='painel_criador.php';</script>";
} else {
    echo "Erro ao salvar palavra: " . $conexao->error;
}
?>
