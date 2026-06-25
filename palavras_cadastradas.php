<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$palavras = $conexao->query("SELECT * FROM palavras ORDER BY palavra ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palavras Cadastradas</title>
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

    <button onclick="lerPagina()">
        🔊 Audiodescrição
    </button>

    <button onclick="pararLeitura()">
        ⏹️ Parar Leitura
    </button>

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
        <h1>Palavras</h1>
       
    </div>
    <div class="acoes-topo">
    <a href="dashboard.php" class="botao-painel">
    📊 Voltar ao Dashboard
</a>
</div>

    <div class="sobre-box">
<?php while ($palavra = $palavras->fetch_assoc()) { ?>

<div class="sugestao-item pequeno">

    <h3><?= $palavra['palavra']; ?></h3>

    <div class="acoes-palavra">

        <a href="editar_palavra.php?id=<?= $palavra['id']; ?>">
            ✏️ Editar
        </a>

        <a
            href="excluir_palavra.php?id=<?= $palavra['id']; ?>"
            onclick="return confirm('Deseja excluir esta palavra?')">
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
   <script>
setTimeout(function(){

    const sucesso = document.querySelector('.alerta-sucesso');
    const erro = document.querySelector('.alerta-erro');

    if(sucesso){
        sucesso.remove();
    }

    if(erro){
        erro.remove();
    }

}, 4000);
</script>
</body>
</html>