<?php
include "conexao.php";

$aleatoria = $conexao->query("
    SELECT id
    FROM palavras
    ORDER BY RAND()
    LIMIT 1
")->fetch_assoc();

$ultimas = $conexao->query("
    SELECT *
    FROM palavras
    ORDER BY id DESC
    LIMIT 8
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinalário | Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css?v=10">
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

<main class="sinalario-page">

    <section class="sinalario-hero-claro">
        <div class="sinalario-hero-texto">
            <span class="sinalario-tag">ACESSIBILIDADE + TECNOLOGIA</span>

            <h1>🤟 Sinalário Digital</h1>

            <p>
                Pesquise termos de Desenvolvimento de Sistemas e aprenda tecnologia
                com apoio da Libras, de forma simples e acessível.
            </p>

            <div class="campo-pesquisa sinalario-busca">
                <input
                    type="text"
                    id="pesquisa"
                    placeholder="Digite uma palavra, exemplo: HTML, CSS, variável..."
                    onkeyup="buscar()"
                >

                <button onclick="buscar()" aria-label="Pesquisar palavra">
                    🔍
                </button>
            </div>

            <div id="resultado"></div>
        </div>

        <div class="sinalario-hero-card">
            <div class="icone-grande">💻</div>
            <h3>Aprenda no seu ritmo</h3>
            <p>Escolha uma categoria ou pesquise uma palavra técnica.</p>
        </div>
    </section>

    <section class="sinalario-categorias">
        <div class="titulo-secao">
            <span>📚</span>
            <h2>Navegue por categorias</h2>
        </div>

        <div class="categorias-home categorias-sinalario">
            <a href="categoria.php?nome=Lógica de Programação"><span>🧠</span>Lógica de Programação</a>
            <a href="categoria.php?nome=HTML"><span>🏗️</span>HTML</a>
            <a href="categoria.php?nome=CSS"><span>🎨</span>CSS</a>
            <a href="categoria.php?nome=JavaScript"><span>⚡</span>JavaScript</a>
            <a href="categoria.php?nome=PHP"><span>🐘</span>PHP</a>
            <a href="categoria.php?nome=Java"><span>☕</span>Java</a>
            <a href="categoria.php?nome=Python"><span>🐍</span>Python</a>
            <a href="categoria.php?nome=Banco de Dados"><span>🗄️</span>Banco de Dados</a>
            <a href="categoria.php?nome=Front-End"><span>🌐</span>Front-End</a>
            <a href="categoria.php?nome=Back-End"><span>⚙️</span>Back-End</a>
            <a href="categoria.php?nome=UX/UI"><span>🖌️</span>UX/UI</a>
            <a href="categoria.php?nome=Cloud"><span>☁️</span>Cloud</a>
        </div>
    </section>

    <section class="sinalario-linha-cards">

        <div class="sinalario-card-menor">
            <div class="card-icone">🎲</div>
            <div>
                <h2>Descubra uma palavra</h2>
                <p>Aprenda um termo aleatório do sinalário.</p>

                <?php if ($aleatoria) { ?>
                    <a class="btn-sinalario" href="palavra.php?id=<?php echo $aleatoria['id']; ?>">
                        Aprender agora
                    </a>
                <?php } ?>
            </div>
        </div>

        <div class="sinalario-card-menor">
            <div class="card-icone">💡</div>
            <div>
                <h2>Não encontrou uma palavra?</h2>
                <p>Ajude o projeto sugerindo um novo termo.</p>
                <a class="btn-sinalario btn-claro" href="sugestoes.php">
                    Sugerir palavra
                </a>
            </div>
        </div>

    </section>

    <section class="sinalario-ultimas">
        <div class="titulo-secao">
            <span>🆕</span>
            <h2>Últimas palavras adicionadas</h2>
        </div>

        <div class="ultimas-chips">
            <?php while($p = $ultimas->fetch_assoc()) { ?>
                <a href="palavra.php?id=<?php echo $p['id']; ?>">
                    <?php echo htmlspecialchars($p['palavra']); ?>
                </a>
            <?php } ?>
        </div>
    </section>

</main>

<script>
function buscar() {
    let valor = document.getElementById("pesquisa").value;
    let resultado = document.getElementById("resultado");

    if (valor.trim() === "") {
        resultado.innerHTML = "";
        return;
    }

    fetch("buscar_palavras.php?busca=" + encodeURIComponent(valor))
        .then(response => response.text())
        .then(data => {
            resultado.innerHTML = data;
        });
}
</script>

<script src="js/acessibilidade.js?v=10"></script>

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
