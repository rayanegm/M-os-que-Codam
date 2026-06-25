<?php
session_start();

include "conexao.php";

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM criadores 
        WHERE usuario = '$usuario' 
        AND senha = '$senha'";

$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {

    $_SESSION['criador'] = $usuario;

     header("Location: dashboard.php");
    exit;

} else {

    echo "<script>
            alert('Usuário ou senha incorretos!');
            window.location.href='login.php';
          </script>";
}
?>