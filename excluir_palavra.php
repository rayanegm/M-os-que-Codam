<?php

session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$id = intval($_GET['id']);

$sql = "DELETE FROM palavras WHERE id = $id";

if ($conexao->query($sql) === TRUE) {

    $_SESSION['sucesso'] = "Palavra excluída com sucesso!";

} else {

    $_SESSION['erro'] = "Erro ao excluir palavra.";

}

header("Location: palavras_cadastradas.php");
exit;