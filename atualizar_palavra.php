<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";
include "config_colunas.php";

$id = (int)($_POST['id'] ?? 0);
$palavra = $_POST['palavra'] ?? '';
$video = $_POST['video'] ?? '';
$categoria = $_POST['categoria'] ?? 'Programação';
$nivel = $_POST['nivel'] ?? 'Iniciante';
$resumo = $_POST['resumo'] ?? '';
$descricao_sinal = $_POST['descricao_sinal'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$exemplo_portugues = $_POST['exemplo_portugues'] ?? '';

$sql = "UPDATE palavras SET
        palavra = ?,
        video = ?,
        categoria = ?,
        nivel = ?,
        resumo = ?,
        descricao_sinal = ?,
        codigo = ?,
        exemplo_portugues = ?
        WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssssssi", $palavra, $video, $categoria, $nivel, $resumo, $descricao_sinal, $codigo, $exemplo_portugues, $id);

if ($stmt->execute()) {
    echo "<script>alert('Palavra atualizada com sucesso!'); window.location.href='painel_criador.php';</script>";
} else {
    echo "Erro ao atualizar: " . $conexao->error;
}
?>
