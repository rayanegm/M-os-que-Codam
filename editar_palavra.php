<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";
include "config_colunas.php";

$id = (int)($_GET['id'] ?? 0);
$stmt = $conexao->prepare("SELECT * FROM palavras WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "Palavra não encontrada.";
    exit;
}

$palavra = $resultado->fetch_assoc();

function selecionado($valorAtual, $valorOption) {
    return ($valorAtual === $valorOption) ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Palavra</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/painel.css">
</head>

<body>
<div class="acessibilidade-flutuante">
    <button class="btn-acessibilidade" onclick="abrirAcessibilidade()">♿</button>
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
        <span>Mãos que Codam</span>
    </div>
    <nav class="menu">
        <a href="painel_criador.php">Painel</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<main class="formulario-card">
    <div class="titulo-palavra">
        <h1>Editar Palavra</h1>
        <p>Atualize as informações da palavra e da mini aula.</p>
    </div>

    <div class="sobre-box sugestao-box">
        <form class="form-sugestao" action="atualizar_palavra.php" method="POST">
            <input type="hidden" name="id" value="<?php echo (int)$palavra['id']; ?>">

            <label>Nome da palavra</label>
            <input type="text" name="palavra" value="<?php echo htmlspecialchars($palavra['palavra'] ?? ''); ?>" required>

            <label>Link do vídeo do YouTube</label>
            <input type="text" name="video" value="<?php echo htmlspecialchars($palavra['video'] ?? ''); ?>" required>

            <div class="grid-form">
                <div>
                    <label>Categoria</label>
                    <select name="categoria" required>
                        <?php
                        $categorias = ['Lógica de Programação','HTML','CSS','JavaScript','PHP','Java','Python','Banco de Dados','Front-End','Back-End','UX/UI','Cloud'];
                        foreach ($categorias as $cat) {
                            echo '<option value="'.htmlspecialchars($cat).'" '.selecionado($palavra['categoria'] ?? '', $cat).'>'.htmlspecialchars($cat).'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label>Nível</label>
                    <select name="nivel" required>
                        <?php
                        $niveis = ['Iniciante','Intermediário','Avançado'];
                        foreach ($niveis as $niv) {
                            echo '<option value="'.htmlspecialchars($niv).'" '.selecionado($palavra['nivel'] ?? '', $niv).'>'.htmlspecialchars($niv).'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <label>Resumo / significado da palavra</label>
            <textarea name="resumo" required><?php echo htmlspecialchars($palavra['resumo'] ?? ''); ?></textarea>

            <label>✋ Como fazer o sinal?</label>
            <textarea name="descricao_sinal" required><?php echo htmlspecialchars($palavra['descricao_sinal'] ?? ''); ?></textarea>

            <label>💻 Exemplo de código</label>
            <textarea name="codigo" class="campo-codigo" required><?php echo htmlspecialchars($palavra['codigo'] ?? ''); ?></textarea>

            <label>💬 Explicação do código em português</label>
            <textarea name="exemplo_portugues" required><?php echo htmlspecialchars($palavra['exemplo_portugues'] ?? ''); ?></textarea>

            <button type="submit" class="btn-salvar">Salvar Alterações 🚀</button>
        </form>
    </div>
</main>

<script src="js/acessibilidade.js"></script>
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper><div class="vw-plugin-top-wrapper"></div></div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
</body>
</html>
