<?php
session_start();


if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$sugestoes = $conexao->query("SELECT * FROM sugestoes ORDER BY data_envio DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugestões</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php if(isset($_SESSION['sucesso'])) { ?>

<div class="alerta-sucesso">
    <?= $_SESSION['sucesso']; ?>
</div>

<?php unset($_SESSION['sucesso']); } ?>

<?php if(isset($_SESSION['erro'])) { ?>

<div class="alerta-erro">
    <?= $_SESSION['erro']; ?>
</div>

<?php unset($_SESSION['erro']); } ?>
    
   <div class="acessibilidade-flutuante">

    <button class="btn-acessibilidade" onclick="abrirAcessibilidade()">
        ♿
    </button>

    <div class="menu-acessibilidade" id="menuAcessibilidade">

        <h4>♿ Acessibilidade</h4>

        <button onclick="aumentarFonte()">🔠 Aumentar Fonte</button>
        <button onclick="diminuirFonte()">🔡 Diminuir Fonte</button>
        <button onclick="altoContraste()">🎨 Alto Contraste</button>
        <button onclick="modoEscuro()">🌙 Modo Escuro</button>
        <button onclick="resetarAcessibilidade()">🔄 Restaurar</button>

    </div>

</div>

<header class="topo">
    <div class="logo">
        <img src="./img/logo.png">
        <span>Mãos que Codam</span>
    </div>

    <nav class="menu">
        <a href="painel_criador.php">Painel</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<div class="pagina-palavra">

    <div class="titulo-palavra">
        <h1>Sugestões</h1>
    </div>
<div class="acoes-topo">
   <a href="dashboard.php" class="botao-painel">
    📊 Voltar ao Dashboard
</a>
</div>
    <div class="sobre-box">

        <?php while ($sugestao = $sugestoes->fetch_assoc()) { ?>

            <div class="sugestao-item pequeno">

                <h3><?php echo $sugestao['palavra_sugerida']; ?></h3>

                <p><?php echo $sugestao['descricao']; ?></p>

                <small><?php echo $sugestao['data_envio']; ?></small>

                <div class="acoes-palavra">
                   <a href="excluir_sugestao.php?id=<?php echo $sugestao['id']; ?>"
   onclick="return confirm('Deseja excluir esta sugestão?')">
    🗑️ Excluir
</a>
                </div>

            </div>

        <?php } ?>

    </div>

</div>
<script src="js/acessibilidade.js"></script>
<div vw class="enabled">
    <div vw-access-button class="active"></div>

    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>
new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>
</body>
</html>