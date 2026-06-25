<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Criadores | Mãos que Codam</title>

    <link rel="stylesheet" href="css/style.css?v=60">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        <span>Mãos que Codam</span>
    </div>

    <nav class="menu">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<main class="login-nova-page">

    <section class="login-card-grande">

        <div class="login-info">
            <span class="login-tag">ÁREA RESTRITA</span>

            <h1>Área dos Criadores</h1>

            <p>
                Espaço exclusivo para cadastrar, editar e organizar palavras,
                vídeos em Libras e conteúdos do Sinalário Mãos que Codam.
            </p>

            <div class="login-beneficios">
                <div>
                    <span>🤟</span>
                    <p>Gerencie sinais em Libras</p>
                </div>

                <div>
                    <span>💻</span>
                    <p>Adicione exemplos de código</p>
                </div>

                <div>
                    <span>📚</span>
                    <p>Organize categorias técnicas</p>
                </div>
            </div>
        </div>

        <div class="login-form-card">

            <div class="login-icone">
                🔐
            </div>

            <h2>Login dos Criadores</h2>

            <p class="login-subtexto">
                Entre com seu usuário e senha para acessar o painel.
            </p>

            <form class="form-login-novo" action="verifica_login.php" method="POST">

                <label>
                    <span>👤 Usuário</span>
                    <input
                        type="text"
                        name="usuario"
                        placeholder="Digite seu usuário"
                        required
                    >
                </label>

                <label>
                    <span>🔑 Senha</span>
                    <input
                        type="password"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >
                </label>

                <button type="submit">
                    Entrar 🚀
                </button>

            </form>

            <a href="index.php" class="login-voltar">
                ← Voltar para o início
            </a>

        </div>

    </section>

</main>

<script src="js/acessibilidade.js?v=60"></script>

</body>
</html>
