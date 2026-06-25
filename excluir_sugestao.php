<?php

session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$id = intval($_GET['id']);

$sql = "DELETE FROM sugestoes WHERE id = $id";

if ($conexao->query($sql) === TRUE) {

    $_SESSION['sucesso'] = "Sugestão excluída com sucesso!";

} else {

    $_SESSION['erro'] = "Erro ao excluir sugestão.";

}

header("Location: sugestoes.php");
exit;

?>