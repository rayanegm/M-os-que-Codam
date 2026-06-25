<?php
include "conexao.php";

$categoria = $_GET['nome'] ?? '';

if (empty($categoria)) {
    header("Location: sinalario.php");
    exit;
}

$sql = "SELECT *
        FROM palavras
        WHERE categoria = ?
        ORDER BY palavra ASC";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $categoria);
$stmt->execute();
$resultado = $stmt->get_result();

$total = $resultado->num_rows;

function iconeCategoria($categoria) {
    $categoria = strtolower($categoria);

    if (str_contains($categoria, 'lógica') || str_contains($categoria, 'logica')) return '🧠';
    if (str_contains($categoria, 'html')) return '🏗️';
    if (str_contains($categoria, 'css')) return '🎨';
    if (str_contains($categoria, 'javascript')) return '⚡';
    if (str_contains($categoria, 'php')) return '🐘';
    if (str_contains($categoria, 'java')) return '☕';
    if (str_contains($categoria, 'python')) return '🐍';
    if (str_contains($categoria, 'banco')) return '🗄️';
    if (str_contains($categoria, 'front')) return '🌐';
    if (str_contains($categoria, 'back')) return '⚙️';
    if (str_contains($categoria, 'ux') || str_contains($categoria, 'ui')) return '🖌️';
    if (str_contains($categoria, 'cloud')) return '☁️';

    return '💻';
}

function classeNivel($nivel) {
    $nivel = strtolower(trim((string)$nivel));

    if (str_contains($nivel, 'avanç') || str_contains($nivel, 'avanc')) {
        return 'nivel-avancado';
    }

    if (str_contains($nivel, 'inter')) {
        return 'nivel-intermediario';
    }

    return 'nivel-iniciante';
}

$icone = iconeCategoria($categoria);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($categoria); ?> | Mãos que Codam</title>
    <link rel="stylesheet" href="css/style.css?v=30">
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

<main class="categoria-page">

    <section class="categoria-hero-claro">

        <div class="categoria-icone-grande">
            <?php echo $icone; ?>
        </div>

        <div class="categoria-texto">
            <span class="categoria-tag">CATEGORIA DO SINALÁRIO</span>

            <h1><?php echo htmlspecialchars($categoria); ?></h1>

            <p>
                Aprenda os sinais técnicos desta categoria em Libras,
                com explicações simples para estudantes de tecnologia.
            </p>

            <div class="categoria-acoes">
                <a href="sinalario.php" class="btn-categoria-voltar">
                    ← Voltar ao Sinalário
                </a>

                <span class="categoria-total">
                    📚 <?php echo $total; ?> palavra<?php echo $total == 1 ? '' : 's'; ?> cadastrada<?php echo $total == 1 ? '' : 's'; ?>
                </span>
            </div>
        </div>

    </section>

    <section class="categoria-busca-box">
        <label for="buscaCategoria">🔎 Pesquisar nesta categoria</label>

        <input
            type="text"
            id="buscaCategoria"
            placeholder="Digite uma palavra..."
            onkeyup="filtrarCategoria()"
        >
    </section>

    <section class="categoria-lista-box">

        <?php if ($resultado->num_rows > 0) { ?>

            <div class="categoria-grid" id="listaCategoria">

                <?php while ($palavra = $resultado->fetch_assoc()) {
                    $nivel = $palavra['nivel'] ?? 'Iniciante';
                    $classeNivel = classeNivel($nivel);
                    $resumo = trim((string)($palavra['resumo'] ?? ''));
                ?>

                    <article class="categoria-card" data-palavra="<?php echo strtolower(htmlspecialchars($palavra['palavra'])); ?>">

                        <div class="categoria-card-topo">
                            <div class="categoria-card-icone">
                                <?php echo $icone; ?>
                            </div>

                            <span class="nivel-card <?php echo $classeNivel; ?>">
                                <?php echo htmlspecialchars($nivel); ?>
                            </span>
                        </div>

                        <h2><?php echo htmlspecialchars($palavra['palavra']); ?></h2>

                        <p>
                            <?php
                            if (!empty($resumo)) {
                                echo htmlspecialchars(mb_strimwidth($resumo, 0, 110, "...", "UTF-8"));
                            } else {
                                echo "Mini aula com sinal em Libras e explicação em português.";
                            }
                            ?>
                        </p>

                        <a href="palavra.php?id=<?php echo $palavra['id']; ?>" class="btn-ver-sinal">
                            Ver sinal →
                        </a>

                    </article>

                <?php } ?>

            </div>

            <p id="semResultadoCategoria" class="sem-resultado-categoria" style="display:none;">
                Nenhuma palavra encontrada nesta categoria.
            </p>

        <?php } else { ?>

            <div class="categoria-vazia">
                <h2>😕 Nenhuma palavra cadastrada ainda</h2>
                <p>Esta categoria ainda não possui palavras cadastradas.</p>
                <a href="sinalario.php">← Voltar ao Sinalário</a>
            </div>

        <?php } ?>

    </section>

</main>

<script>
function filtrarCategoria() {
    const busca = document.getElementById("buscaCategoria").value.toLowerCase().trim();
    const cards = document.querySelectorAll(".categoria-card");
    const semResultado = document.getElementById("semResultadoCategoria");

    let encontrados = 0;

    cards.forEach(card => {
        const palavra = card.dataset.palavra;

        if (palavra.includes(busca)) {
            card.style.display = "block";
            encontrados++;
        } else {
            card.style.display = "none";
        }
    });

    if (semResultado) {
        semResultado.style.display = encontrados === 0 ? "block" : "none";
    }
}
</script>

<script src="js/acessibilidade.js?v=30"></script>

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
