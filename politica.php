<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade | Mãos que Codam</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

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
        <img src="img/logo.png" alt="Logo Mãos que Codam">
    </div>

    <nav class="menu">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="contato.php">Contato</a>
    </nav>

</header>

<div class="voltar-politica">

    <a href="index.php" class="btn-voltar">
        ← Voltar ao site
    </a>

</div>

<div class="pagina-politica">

    <h1>Política de Privacidade</h1>

    <p>
        O projeto Mãos que Codam respeita a privacidade dos usuários e está comprometido em proteger as informações fornecidas durante a utilização do site.
    </p>

    <h2>Informações coletadas</h2>

    <p>
        Podemos coletar informações fornecidas voluntariamente pelos usuários, como nome, e-mail, telefone e sugestões enviadas pelos formulários disponíveis no site.
    </p>

    <h2>Uso das informações</h2>

    <p>
        As informações coletadas são utilizadas exclusivamente para:
    </p>

    <ul>
        <li>Melhorar o conteúdo do sinalário;</li>
        <li>Entrar em contato com participantes do projeto;</li>
        <li>Analisar sugestões enviadas pelos usuários;</li>
        <li>Promover melhorias de acessibilidade.</li>
    </ul>

    <h2>Compartilhamento de dados</h2>

    <p>
        O projeto não vende, aluga ou compartilha dados pessoais com terceiros, exceto quando exigido por lei.
    </p>

    <h2>Cookies</h2>

    <p>
        O site pode utilizar cookies para melhorar a experiência do usuário e armazenar preferências de acessibilidade.
    </p>

    <h2>Segurança</h2>

    <p>
        Adotamos medidas para proteger as informações armazenadas contra acessos não autorizados.
    </p>

    <h2>Contato</h2>

    <p>
        Em caso de dúvidas sobre esta Política de Privacidade, entre em contato com a equipe do projeto Mãos que Codam.
    </p>

    <p>
        Última atualização: 2026.
    </p>

</div>

<footer class="rodape">

    <div class="rodape-conteudo">

     

        <p>
            Promovendo acessibilidade e inclusão na área de tecnologia através da Libras.
        </p>

        <div class="rodape-links">
            <a href="index.php">Início</a>
            <a href="sinalario.php">Sinalário</a>
            <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="contato.php">Contato</a>
            <a href="politica.php">Política de Privacidade</a>
        </div>

        <small>
            © 2026 Mãos que Codam - Todos os direitos reservados.
        </small>

    </div>

</footer>

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

<script src="js/acessibilidade.js"></script>

</body>
</html>
