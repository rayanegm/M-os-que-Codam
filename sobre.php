<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre | Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css?v=50">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

<main class="sobre-nova-page">

    <section class="sobre-hero-novo">
        <div class="sobre-hero-texto">
            <span class="sobre-tag">INCLUSÃO + TECNOLOGIA + LIBRAS</span>
            <h1>Sobre o Mãos que Codam</h1>
            <p>
                Um projeto criado para aproximar estudantes surdos da tecnologia,
                reunindo sinais técnicos, vídeos em Libras e explicações simples
                sobre programação e desenvolvimento de sistemas.
            </p>
            <div class="sobre-hero-botoes">
                <a href="sinalario.php" class="btn-sobre-principal">🤟 Explorar sinalário</a>
                <a href="contato.php" class="btn-sobre-secundario">📩 Entrar em contato</a>
            </div>
        </div>

        <div class="sobre-hero-card">
            <div class="sobre-icone-maior">💻</div>
            <h3>Tecnologia acessível</h3>
            <p>Aprender programação também precisa ser visual, inclusivo e humano.</p>
        </div>
    </section>

    <section class="sobre-cards-grid">
        <article class="sobre-card-novo">
            <div class="sobre-card-icone">✨</div>
            <h2>Como tudo começou</h2>
            <p>O Mãos que Codam nasceu ao percebermos a dificuldade que muitas pessoas surdas enfrentam para encontrar sinais relacionados aos termos técnicos da programação e da área de ADS.</p>
            <p>Muitos sinais ficam espalhados em vários lugares, dificultando o aprendizado e criando barreiras na educação.</p>
        </article>

        <article class="sobre-card-novo">
            <div class="sobre-card-icone">🚧</div>
            <h2>Barreiras que queremos reduzir</h2>
            <ul>
                <li>Falta de glossário técnico acessível.</li>
                <li>Comunicação limitada em ambientes educacionais.</li>
                <li>Exclusão digital de estudantes surdos.</li>
                <li>Dificuldade para encontrar sinais técnicos em um só lugar.</li>
            </ul>
        </article>

        <article class="sobre-card-novo">
            <div class="sobre-card-icone">🎯</div>
            <h2>Nossa missão</h2>
            <p>Promover inclusão educacional, oferecendo acesso igualitário ao conhecimento técnico em programação para estudantes surdos.</p>
            <p>Também buscamos reduzir a evasão escolar causada pela falta de materiais acessíveis e impulsionar a formação de novos profissionais.</p>
        </article>

        <article class="sobre-card-novo">
            <div class="sobre-card-icone">🚀</div>
            <h2>Expansão futura</h2>
            <ul>
                <li>Cursos técnicos em Libras, gratuitos e premium.</li>
                <li>Certificação para fortalecer o currículo.</li>
                <li>Expansão para múltiplas áreas da tecnologia.</li>
                <li>Plataforma completa unindo teoria e prática.</li>
            </ul>
        </article>
    </section>

    <section class="sobre-contato-novo">
        <div class="titulo-secao-sobre">
            <span>📞</span>
            <h2>Entre em contato</h2>
        </div>
        <p class="sobre-subtexto">
            Quer saber mais sobre o projeto, enviar uma dúvida ou propor uma parceria?
            Fale com a equipe do Mãos que Codam.
        </p>

        <div class="contato-cards-grid">
            <div class="contato-card-novo"><span>📷</span><h3>Instagram</h3><p>@maosquecodam</p></div>
            <div class="contato-card-novo"><span>✉️</span><h3>E-mail</h3><p>contato@maosquecodam.com.br</p></div>
            <div class="contato-card-novo"><span>📘</span><h3>Facebook</h3><p>/maosquecodam</p></div>
            <div class="contato-card-novo"><span>📞</span><h3>Telefone</h3><p>(13) 99999-9999</p></div>
        </div>

        <a href="contato.php" class="btn-sobre-principal contato-botao-final">Abrir formulário de contato →</a>
    </section>

    <section class="sobre-sugestao-nova">
        <div class="sugestao-texto">
            <span>💡</span>
            <h2>Envie uma sugestão</h2>
            <p>Sentiu falta de uma palavra no sinalário? Envie uma sugestão para ajudar o projeto a crescer.</p>
        </div>

        <form class="form-sugestao-nova" action="salvar_sugestao.php" method="POST">
            <input type="text" name="palavra_sugerida" placeholder="Qual palavra você gostaria de ver?" required>
            <textarea name="descricao" placeholder="Explique sua sugestão ou ideia..." required></textarea>
            <button type="submit">Enviar sugestão</button>
        </form>
    </section>

    <section class="sobre-frase-final">
        <h2>Tecnologia acessível transforma vidas.</h2>
        <p>Junte-se ao Mãos que Codam nessa missão de inclusão.</p>
    </section>

</main>

<script src="js/acessibilidade.js?v=50"></script>

<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

</body>
</html>
