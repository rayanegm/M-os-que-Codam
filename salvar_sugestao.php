<?php

include "conexao.php";

$palavra = $_POST['palavra_sugerida'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO sugestoes (palavra_sugerida, descricao)
        VALUES ('$palavra', '$descricao')";

if ($conexao->query($sql) === TRUE) {
    echo "<script>
            alert('Sugestão enviada com sucesso!');
            window.location.href='sobre.php';
          </script>";
} else {
    echo "Erro ao enviar sugestão: " . $conexao->error;
}

?>