<?php
session_start();
include "conexao.php";

$nome = trim($_POST['nome_completo'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$comentario = trim($_POST['comentario'] ?? '');
$tipo = trim($_POST['tipo_participacao'] ?? 'Contato');

$voltar = ($tipo === 'Contato') ? 'contato.php' : 'participar.php';

if ($nome === '' || $email === '' || $comentario === '') {
    $_SESSION['erro'] = 'Preencha nome, e-mail e mensagem.';
    header("Location: $voltar");
    exit;
}

$stmt = $conexao->prepare("INSERT INTO participantes (nome_completo, email, telefone, comentario, tipo_participacao) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $email, $telefone, $comentario, $tipo);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = ($tipo === 'Contato') ? 'Mensagem enviada com sucesso!' : 'Interesse enviado com sucesso!';
} else {
    $_SESSION['erro'] = 'Erro ao enviar. Tente novamente.';
}

header("Location: $voltar");
exit;
?>
