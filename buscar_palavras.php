<?php

include "conexao.php";

$busca = $_GET['busca'];

$sql = "SELECT * FROM palavras 
        WHERE palavra LIKE '%$busca%'";

$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {

    while ($linha = $resultado->fetch_assoc()) {

        echo "<a href='palavra.php?id=".$linha['id']."' class='item'>"
             .$linha['palavra'].
             "</a>";
    }

} else {

    echo "<p class='sem-resultado'>Nenhuma palavra encontrada.</p>";
}

?>