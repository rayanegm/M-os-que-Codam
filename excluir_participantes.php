<?php

session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$id = intval($_GET['id']);

$sql = "DELETE FROM participantes WHERE id = $id";

if ($conexao->query($sql) === TRUE) {

    $_SESSION['sucesso'] = "Participante excluído com sucesso!";

} else {

    $_SESSION['erro'] = "Erro ao excluir participante.";

}

header("Location: participantes.php");
exit;