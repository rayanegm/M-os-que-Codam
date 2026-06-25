<?php
include "conexao.php";
include "config_colunas.php";

if (!isset($_GET['id'])) {
    header("Location: sinalario.php");
    exit;
}

$id = (int) $_GET['id'];

$conexao->query("UPDATE palavras SET visualizacoes = visualizacoes + 1 WHERE id = $id");

$sql = "SELECT * FROM palavras WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    header("Location: sinalario.php");
    exit;
}

$palavra = $resultado->fetch_assoc();

$categoria = $palavra['categoria'] ?? 'Programação';
$nivelTexto = $palavra['nivel'] ?? 'Iniciante';

$relacionadas = $conexao->prepare("
    SELECT id, palavra
    FROM palavras
    WHERE categoria = ? AND id != ?
    ORDER BY palavra ASC
    LIMIT 8
");
$relacionadas->bind_param("si", $categoria, $id);
$relacionadas->execute();
$listaRelacionadas = $relacionadas->get_result();

$anterior = $conexao->prepare("
    SELECT id, palavra
    FROM palavras
    WHERE id < ?
    ORDER BY id DESC
    LIMIT 1
");
$anterior->bind_param("i", $id);
$anterior->execute();
$palavraAnterior = $anterior->get_result()->fetch_assoc();

$proxima = $conexao->prepare("
    SELECT id, palavra
    FROM palavras
    WHERE id > ?
    ORDER BY id ASC
    LIMIT 1
");
$proxima->bind_param("i", $id);
$proxima->execute();
$palavraProxima = $proxima->get_result()->fetch_assoc();

function youtubeEmbed($url) {
    if (empty($url)) return "";
    if (strpos($url, 'embed') !== false) return $url;

    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $url, $matches);

    if (!empty($matches[1])) {
        return "https://www.youtube.com/embed/" . $matches[1];
    }

    return $url;
}

function valorOuMensagem($valor, $mensagem) {
    return !empty(trim((string)$valor)) ? nl2br(htmlspecialchars($valor)) : $mensagem;
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

$nivelClasse = classeNivel($nivelTexto);
$video = youtubeEmbed($palavra['video'] ?? '');
$codigo = trim((string)($palavra['codigo'] ?? ''));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($palavra['palavra']); ?> | Mãos que Codam</title>

    <link rel="stylesheet" href="css/style.css?v=20">
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
        <img src="./img/logo.png" alt="Mãos que Codam">
    </div>

    <nav class="menu">
        <a href="index.php">Início</a>
        <a href="sinalario.php">Sinalário</a>
        <a href="sobre.php">Sobre</a>
        <a href="aulas.php">Aulas</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<main class="palavra-page-nova">

    <!-- CABEÇALHO CLARO -->
    <section class="palavra-cabecalho-claro">
        <div class="palavra-cabecalho-texto">

            <div class="palavra-tags-topo">
                <span class="chip-categoria">🏷️ <?php echo htmlspecialchars($categoria); ?></span>

                <span class="chip-nivel <?php echo $nivelClasse; ?>">
                    🎯 <?php echo htmlspecialchars($nivelTexto); ?>
                </span>
            </div>

            <h1><?php echo htmlspecialchars($palavra['palavra']); ?></h1>

            <p>
                Mini aula com sinal em Libras, conceito em português,
                explicação simples e exemplo de código.
            </p>

            <div class="acoes-palavra-nova">
                <button type="button" onclick="compartilharPalavra()" class="btn-palavra-acao">
                    📤 Compartilhar palavra
                </button>

                <a href="sinalario.php" class="btn-palavra-acao btn-palavra-secundario">
                    ← Voltar ao sinalário
                </a>
            </div>

        </div>

        <aside class="palavra-status-card">
            <div class="status-item">
                <strong><?php echo (int)($palavra['visualizacoes'] ?? 0) + 1; ?></strong>
                <span>visualizações</span>
            </div>

            <div class="status-item <?php echo $nivelClasse; ?>">
                <small>Nível</small>
                <b><?php echo htmlspecialchars($nivelTexto); ?></b>
            </div>
        </aside>
    </section>

    <!-- VÍDEO E SIGNIFICADO -->
    <section class="palavra-video-grid">

        <article class="video-card-palavra video-card-maior">
            <div class="card-topo-palavra">
                <span>🎥 Sinal em Libras</span>
                <small>Vídeo explicativo</small>
            </div>

            <div class="video-responsivo">
                <?php if (!empty($video)) { ?>
                    <iframe src="<?php echo htmlspecialchars($video); ?>" title="Sinal em Libras" allowfullscreen></iframe>
                <?php } else { ?>
                    <div class="sem-video">
                        <strong>🎥 Vídeo ainda não cadastrado</strong>
                        <p>Em breve este termo terá o sinal em Libras.</p>
                    </div>
                <?php } ?>
            </div>
        </article>

        <aside class="significado-card-menor">
            <div class="icone-card">📚</div>

            <h2>O que significa?</h2>

            <p><?php echo valorOuMensagem($palavra['resumo'] ?? '', 'Resumo ainda não cadastrado.'); ?></p>

            <div class="mini-tags-palavra">
                <span>#Libras</span>
                <span>#Tecnologia</span>
                <span>#<?php echo htmlspecialchars($categoria); ?></span>
            </div>
        </aside>

    </section>

    <!-- EXPLICAÇÕES -->
    <section class="explicacoes-duplas">
        <article class="explicacao-card-novo">
            <div class="icone-explicacao-maior">✋</div>

            <div>
                <h2>Como fazer o sinal?</h2>
                <p><?php echo valorOuMensagem($palavra['descricao_sinal'] ?? '', 'Descrição do sinal ainda não cadastrada.'); ?></p>
            </div>
        </article>

        <article class="explicacao-card-novo">
            <div class="icone-explicacao-maior">💬</div>

            <div>
                <h2>Explicação em Português</h2>
                <p><?php echo valorOuMensagem($palavra['exemplo_portugues'] ?? '', 'Explicação ainda não cadastrada.'); ?></p>
            </div>
        </article>
    </section>

    <!-- CÓDIGO -->
    <section class="codigo-card-palavra codigo-vscode-novo">

        <div class="editor-topo">
            <div class="bolinha vermelho"></div>
            <div class="bolinha amarelo"></div>
            <div class="bolinha verde"></div>

            <span class="arquivo"><?php echo htmlspecialchars($categoria); ?>.js</span>

            <button type="button" class="btn-copiar-codigo" onclick="copiarCodigo()">
                📋 Copiar código
            </button>
        </div>

        <div class="codigo-editor">
            <div class="linhas">
                <?php
                $linhas = max(1, substr_count($codigo, "\n") + 1);

                for($i = 1; $i <= $linhas; $i++) {
                    echo $i . "<br>";
                }
                ?>
            </div>

            <div class="codigo">
                <pre><code id="codigoTexto"><?php
echo !empty($codigo)
    ? htmlspecialchars($codigo)
    : 'Exemplo de código ainda não cadastrado.';
?></code></pre>
            </div>
        </div>

    </section>

    <!-- NAVEGAÇÃO -->
    <section class="navegacao-palavras-nova">

        <?php if ($palavraAnterior) { ?>
            <a class="nav-palavra-card" href="palavra.php?id=<?php echo $palavraAnterior['id']; ?>">
                <span>← Palavra anterior</span>
                <strong><?php echo htmlspecialchars($palavraAnterior['palavra']); ?></strong>
            </a>
        <?php } else { ?>
            <div class="nav-palavra-card desativada">
                <span>← Palavra anterior</span>
                <strong>Não há palavra anterior</strong>
            </div>
        <?php } ?>

        <?php if ($palavraProxima) { ?>
            <a class="nav-palavra-card direita" href="palavra.php?id=<?php echo $palavraProxima['id']; ?>">
                <span>Próxima palavra →</span>
                <strong><?php echo htmlspecialchars($palavraProxima['palavra']); ?></strong>
            </a>
        <?php } else { ?>
            <div class="nav-palavra-card desativada direita">
                <span>Próxima palavra →</span>
                <strong>Não há próxima palavra</strong>
            </div>
        <?php } ?>

    </section>

    <!-- RELACIONADAS -->
    <section class="relacionadas-card-palavra relacionadas-nova">
        <div class="card-topo-palavra">
            <span>🔗 Palavras relacionadas</span>
            <small>Continue explorando</small>
        </div>

        <div class="relacionadas-lista-palavra relacionadas-chips-nova">
            <?php if ($listaRelacionadas->num_rows > 0) { ?>
                <?php while($item = $listaRelacionadas->fetch_assoc()) { ?>
                    <a href="palavra.php?id=<?php echo $item['id']; ?>">
                        <?php echo htmlspecialchars($item['palavra']); ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="sem-relacionadas">Nenhuma palavra relacionada ainda.</p>
            <?php } ?>
        </div>
    </section>

</main>

<div id="toastAcao" class="toast-acao">Copiado!</div>

<script>
function mostrarToast(texto) {
    const toast = document.getElementById("toastAcao");

    toast.innerText = texto;
    toast.classList.add("mostrar-toast");

    setTimeout(() => {
        toast.classList.remove("mostrar-toast");
    }, 2600);
}

function copiarCodigo() {
    const codigo = document.getElementById("codigoTexto").innerText;

    navigator.clipboard.writeText(codigo)
        .then(() => mostrarToast("Código copiado!"))
        .catch(() => mostrarToast("Não foi possível copiar."));
}

function compartilharPalavra() {
    const titulo = "<?php echo addslashes($palavra['palavra']); ?> | Mãos que Codam";
    const texto = "Veja esta palavra no Sinalário Mãos que Codam:";
    const url = window.location.href;

    if (navigator.share) {
        navigator.share({
            title: titulo,
            text: texto,
            url: url
        });
    } else {
        navigator.clipboard.writeText(url)
            .then(() => mostrarToast("Link da palavra copiado!"))
            .catch(() => mostrarToast("Não foi possível compartilhar."));
    }
}
</script>

<script src="js/acessibilidade.js?v=20"></script>

<!-- VLIBRAS -->
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
