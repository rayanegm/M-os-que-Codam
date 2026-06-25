<?php
include "conexao.php";

$populares = $conexao->query("
    SELECT *
    FROM palavras
    ORDER BY visualizacoes DESC
    LIMIT 5
");

$total_palavras = $conexao->query("SELECT COUNT(*) AS total FROM palavras")->fetch_assoc();
$total_sugestoes = $conexao->query("SELECT COUNT(*) AS total FROM sugestoes")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css?v=80">
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

<header class="header-home">
    <div class="logo-home">
        <img src="img/logo.png" alt="Mãos que Codam">
    </div>

    <nav class="menu-home">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="login.php" class="btn-entrar">Entrar</a>
    </nav>
</header>

<main class="home-limpa">

    <section class="home-limpa-hero">
        <div class="home-limpa-texto">
            <span class="home-limpa-tag">INCLUSÃO • TECNOLOGIA • LIBRAS</span>
            <h1>Mãos que Codam</h1>
            <p>
                Sinalário digital com termos de tecnologia em Libras,
                criado para apoiar estudantes surdos na área de desenvolvimento de sistemas.
            </p>

            <div class="home-limpa-botoes">
                <a href="sinalario.php" class="btn-home-principal">🤟 Acessar Sinalário</a>
                <a href="sobre.php" class="btn-home-secundario">Conhecer Projeto</a>
            </div>
        </div>

        <div class="home-limpa-logo">
            <img src="img/logo.png" alt="Logo Mãos que Codam">
        </div>
    </section>

    <section class="home-limpa-busca">
        <h2>🔎 Pesquise uma palavra</h2>

        <div class="campo-busca-home">
            <input type="text" id="pesquisa" placeholder="Digite uma palavra..." onkeyup="buscar()">
            <button onclick="buscar()">🔍</button>
        </div>

        <div id="resultado"></div>

        <div class="sugestoes-rapidas">
            <?php while($palavra = $populares->fetch_assoc()) { ?>
                <a href="palavra.php?id=<?php echo $palavra['id']; ?>" class="tag-popular">
                    🔥 <?php echo htmlspecialchars($palavra['palavra']); ?>
                </a>
            <?php } ?>
        </div>
    </section>

    <section class="home-limpa-cards">
        <div><span>🤟</span><h3>Sinais em Libras</h3><p>Vídeos com sinais técnicos da tecnologia.</p></div>
        <div><span>💻</span><h3>Programação</h3><p>Termos de ADS explicados de forma simples.</p></div>
        <div><span>🚀</span><h3>Acessibilidade</h3><p>Aprendizado mais visual, inclusivo e acessível.</p></div>
    </section>

    <section class="home-limpa-estatisticas">
        <div><h3><?php echo $total_palavras['total']; ?>+</h3><p>Palavras cadastradas</p></div>
        <div><h3><?php echo $total_sugestoes['total']; ?>+</h3><p>Sugestões recebidas</p></div>
        <div><h3></h3><p>Foco em acessibilidade</p></div>
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
    <div class="footer-links">
        <a href="politica.php">Política de Privacidade</a>
        <a href="termos.php">Termos de Uso</a>
    </div>
</footer>

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

<script src="js/acessibilidade.js?v=80"></script>

<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

</body>
</html>
