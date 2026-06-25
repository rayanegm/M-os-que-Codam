<?php
include "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas | Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css?v=40">
</head>

<body>

<!-- ACESSIBILIDADE -->
<div class="acessibilidade-flutuante">
    <button class="btn-acessibilidade" onclick="abrirAcessibilidade()" aria-label="Abrir menu de acessibilidade">
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
        <img src="./img/logo.png" alt="Logo Mãos que Codam">
    </div>

    <nav class="menu">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<main class="aulas-nova-page">

    <section class="aulas-hero-novo">

        <div class="aulas-hero-texto">
            <span class="aulas-tag">AULAS EM BREVE</span>

            <h1>Aprenda Tecnologia em Libras</h1>

            <p>
                Estamos preparando uma área de aulas com vídeos, exemplos de código,
                exercícios práticos e explicações acessíveis em português.
            </p>

            <div class="aulas-hero-botoes">
                <a href="sinalario.php" class="btn-aula-principal">🚀 Acessar sinalário</a>
                <a href="contato.php" class="btn-aula-secundario">📩 Entre em contato</a>
            </div>
        </div>

        <div class="aulas-hero-ilustra">
            <div class="aulas-ilustra-card">
                <div class="aulas-icone-maior">🤟</div>
                <h3>Libras + Código</h3>
                <p>Uma plataforma pensada para estudantes surdos na tecnologia.</p>
            </div>
        </div>

    </section>

    <section class="planos-novos-grid">

        <article class="plano-novo-card plano-free">
            <div class="plano-topo">
                <div class="plano-icone-novo">🤟</div>
                <span class="plano-selo gratis">Gratuito</span>
            </div>

            <h2>Plano Free</h2>
            <h3>R$ 0,00</h3>

            <p>
                Acesso gratuito para conhecer o projeto e consultar os termos técnicos do sinalário.
            </p>

            <ul>
                <li>✅ Acesso ao sinalário</li>
                <li>✅ Vídeos em Libras</li>
                <li>✅ Explicações em português</li>
                <li>✅ Exemplos práticos</li>
            </ul>

            <a href="sinalario.php" class="btn-plano-novo">🚀 Acessar sinalário</a>
        </article>

        <article class="plano-novo-card plano-premium">
            <div class="plano-topo">
                <div class="plano-icone-novo">🚀</div>
                <span class="plano-selo destaque">⭐ Mais completo</span>
            </div>

            <h2>Plano Premium</h2>
            <h3>R$ 19,90/mês</h3>

            <p>
                Valor acessível para manter o projeto, produzir novas aulas e ampliar os sinais técnicos.
            </p>

            <ul>
                <li>✅ Sinalário completo</li>
                <li>✅ Aulas em Libras</li>
                <li>✅ Exercícios práticos</li>
                <li>✅ Material complementar</li>
                <li>✅ Suporte para dúvidas</li>
            </ul>

            <button class="btn-plano-novo btn-em-breve-novo" disabled>🔒 Em breve</button>
        </article>

    </section>

    <section class="aulas-recursos">
        <div class="titulo-secao-aulas">
            <span>📚</span>
            <h2>O que você encontrará?</h2>
        </div>

        <div class="recursos-grid">
            <div class="recurso-card">
                <span>🎥</span>
                <h3>Vídeos em Libras</h3>
                <p>Aulas visuais com explicações acessíveis.</p>
            </div>

            <div class="recurso-card">
                <span>💻</span>
                <h3>Exemplos de código</h3>
                <p>Conteúdos aplicados ao desenvolvimento de sistemas.</p>
            </div>

            <div class="recurso-card">
                <span>📝</span>
                <h3>Exercícios práticos</h3>
                <p>Atividades para reforçar o aprendizado.</p>
            </div>

            <div class="recurso-card">
                <span>📖</span>
                <h3>Português simples</h3>
                <p>Explicações claras para cada termo técnico.</p>
            </div>

            <div class="recurso-card">
                <span>🏆</span>
                <h3>Certificados</h3>
                <p>Recurso planejado para próximas versões.</p>
            </div>

            <div class="recurso-card">
                <span>🤝</span>
                <h3>Suporte</h3>
                <p>Espaço futuro para dúvidas e comunidade.</p>
            </div>
        </div>
    </section>

    <section class="aulas-chamada-final">
        <h2>Estamos construindo tecnologia mais acessível.</h2>
        <p>
            O Mãos que Codam quer aproximar estudantes surdos da programação,
            usando Libras, exemplos visuais e linguagem simples.
        </p>

        <a href="contato.php">📩 Quero saber mais</a>
    </section>

</main>

<script src="js/acessibilidade.js?v=40"></script>

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
