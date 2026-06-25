<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre em Contato | Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="acessibilidade-flutuante">
    <button class="btn-acessibilidade" onclick="abrirAcessibilidade()" aria-label="Abrir menu de acessibilidade">♿</button>
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
    <div class="logo"><img src="./img/logo.png" alt="Logo Mãos que Codam"></div>
    <nav class="menu">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        
        <a href="login.php">Login</a>
    </nav>
</header>

<main class="pagina-palavra contato-page">
    <div class="titulo-palavra">
        <h1>Entre em contato</h1>
        <p>Envie sua mensagem para a equipe do Mãos que Codam.</p>
    </div>

    <?php if(isset($_SESSION['sucesso'])) { ?>
        <div class="alerta-pagina sucesso"><?= $_SESSION['sucesso']; ?></div>
    <?php unset($_SESSION['sucesso']); } ?>

    <?php if(isset($_SESSION['erro'])) { ?>
        <div class="alerta-pagina erro"><?= $_SESSION['erro']; ?></div>
    <?php unset($_SESSION['erro']); } ?>

    <section class="contato-grid">
        <div class="sobre-box contato-card-info">
            <h2>💙 Fale com a gente</h2>
            <p>Use este formulário para dúvidas, sugestões, parcerias, entrevistas, apoio ao projeto ou informações sobre o sinalário.</p>
            <div class="contato-lista">
                <p>📷 Instagram: @maosquecodam</p>
                <p>✉️ E-mail: contato@maosquecodam.com.br</p>
                <p>📘 Facebook: /maosquecodam</p>
                <p>📞 Telefone: (13) 99999-9999</p>
            </div>
        </div>

        <div class="sobre-box sugestao-box">
            <h2>📨 Formulário de contato</h2>
            <form class="form-sugestao" action="salvar_participante.php" method="POST">
                <input type="hidden" name="tipo_participacao" value="Contato">
                <input type="text" name="nome_completo" placeholder="Nome completo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="text" name="telefone" placeholder="Telefone / WhatsApp">
                <textarea name="comentario" placeholder="Digite sua mensagem..." required></textarea>
                <button type="submit">Enviar mensagem 🚀</button>
            </form>
        </div>
    </section>
</main>

<footer class="footer-home footer-contato">
    <img src="img/logo.png" alt="Mãos que Codam">
    <p>Tecnologia e conexão humana.</p>
    <div class="footer-redes">
        <a href="https://instagram.com/maosquecodam" target="_blank">📷 Instagram</a>
        <a href="mailto:contato@maosquecodam.com.br">✉️ contato@maosquecodam.com.br</a>
        <a href="https://facebook.com/maosquecodam" target="_blank">📘 Facebook</a>
        <a href="tel:+5513999999999">📞 (13) 99999-9999</a>
    </div>
</footer>

<script src="js/acessibilidade.js"></script>
<div vw class="enabled"><div vw-access-button class="active"></div><div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div></div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
</body>
</html>
