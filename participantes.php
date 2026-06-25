<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$participantes = $conexao->query("SELECT * FROM participantes ORDER BY data_envio DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos | Mãos que Codam</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css?v=200">
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
        <img src="./img/logo.png" alt="Logo">
    </div>

    <nav class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<div class="pagina-palavra">

    <div class="titulo-palavra">
        <h1>Contatos recebidos</h1>
    </div>
<div class="acoes-topo">
    <a href="dashboard.php" class="btn-voltar">
        ← Voltar ao Dashboard
    </a>
</div>
    <div class="sobre-box">

        <?php if ($participantes->num_rows > 0) { ?>

            <div class="lista-sugestoes">

                <?php while ($p = $participantes->fetch_assoc()) { ?>

                    <div class="sugestao-item">

                        <h3><?php echo $p['nome_completo']; ?></h3>

                        <p><strong>E-mail:</strong> <?php echo $p['email']; ?></p>

                        <p><strong>Telefone:</strong> <?php echo $p['telefone']; ?></p>

                        <p><strong>Tipo:</strong> <?php echo $p['tipo_participacao']; ?></p>

                        <p><strong>Comentário:</strong> <?php echo $p['comentario']; ?></p>

                        <small>
                            Enviado em: <?php echo $p['data_envio']; ?>
                            <div class="acoes-palavra">
    <a
    href="excluir_participantes.php?id=<?php echo $p['id']; ?>"
    onclick="return confirm('Deseja excluir este participante?')"
>
    🗑️ Excluir
</a>
</div>
                        </small>

                    </div>

                <?php } ?>

            </div>

        <?php } else { ?>

            <p>Nenhum contato recebido ainda.</p>

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