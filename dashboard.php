<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

$total_palavras = $conexao->query("SELECT COUNT(*) AS total FROM palavras")->fetch_assoc();
$total_sugestoes = $conexao->query("SELECT COUNT(*) AS total FROM sugestoes")->fetch_assoc();
$total_contatos = $conexao->query("SELECT COUNT(*) AS total FROM participantes")->fetch_assoc();
$total_visualizacoes = $conexao->query("SELECT COALESCE(SUM(visualizacoes),0) AS total FROM palavras")->fetch_assoc();

$mais_acessadas = $conexao->query("SELECT palavra, visualizacoes FROM palavras ORDER BY visualizacoes DESC LIMIT 5");
$ultimas_sugestoes = $conexao->query("SELECT * FROM sugestoes ORDER BY data_envio DESC LIMIT 4");
$ultimos_contatos = $conexao->query("SELECT * FROM participantes ORDER BY data_envio DESC LIMIT 4");
$ultimas_palavras = $conexao->query("SELECT * FROM palavras ORDER BY id DESC LIMIT 5");
$top_visualizacao = $conexao->query("SELECT COALESCE(MAX(visualizacoes),0) AS maximo FROM palavras")->fetch_assoc();
$maximo = max(1, (int)$top_visualizacao['maximo']);

function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Mãos que Codam</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css?v=700">
</head>
<body>
<div class="acessibilidade-flutuante">
    <button class="btn-acessibilidade" onclick="abrirAcessibilidade()" aria-label="Abrir acessibilidade">♿</button>
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

<button class="btn-toggle-sidebar" onclick="toggleSidebar()" aria-label="Abrir ou esconder menu lateral">☰</button>
<div class="painel-layout">
    <aside class="sidebar-painel">
        <div class="sidebar-logo">
            <img src="img/logo.png" alt="Logo Mãos que Codam">
            <strong>Mãos que Codam</strong>
            <small>Painel do Criador</small>
        </div>
        <nav>
            <a href="dashboard.php" class="ativo">📊 Dashboard</a>
            <a href="painel_criador.php">➕ Adicionar Palavra</a>
            <a href="palavras_cadastradas.php">📚 Palavras Cadastradas</a>
            <a href="sugestoes.php">💡 Sugestões</a>
            <a href="participantes.php">📨 Contatos</a>
            <a href="logout.php">🚪 Sair</a>
        </nav>
    </aside>

    <main class="dashboard-main">
        <section class="dashboard-topo">
            <div>
                <span class="tag-dashboard">Tecnologia + Libras + Inclusão</span>
                <h1>Dashboard</h1>
                <p>Resumo geral do projeto Mãos que Codam.</p>
            </div>
            <div class="data-dashboard"><?= date('d/m/Y H:i'); ?></div>
        </section>

        <section class="dashboard-cards-serio">
            <article class="card-serio">
                <span class="icone-card livros">📚</span>
                <div class="card-conteudo"><p>Palavras cadastradas</p><h2><?= h($total_palavras['total']); ?></h2><div class="mini-chart"><div class="grafico grafico-verde"></div></div></div>
            </article>
            <article class="card-serio">
                <span class="icone-card roxo">💡</span>
                <div class="card-conteudo"><p>Sugestões recebidas</p><h2><?= h($total_sugestoes['total']); ?></h2><div class="mini-chart"><div class="grafico grafico-roxo"></div></div></div>
            </article>
            <article class="card-serio">
                <span class="icone-card azul">📨</span>
                <div class="card-conteudo"><p>Contatos recebidos</p><h2><?= h($total_contatos['total']); ?></h2><div class="mini-chart"><div class="grafico grafico-azul"></div></div></div>
            </article>
            <article class="card-serio">
                <span class="icone-card amarelo">👁️</span>
                <div class="card-conteudo"><p>Acessos aos sinais</p><h2><?= h($total_visualizacoes['total']); ?></h2><div class="mini-chart"><div class="grafico grafico-amarelo"></div></div></div>
            </article>
        </section>

        <section class="atalhos-dashboard">
            <a href="painel_criador.php">➕ Cadastrar palavra</a>
            <a href="palavras_cadastradas.php">📚 Gerenciar sinalário</a>
            <a href="sugestoes.php">💡 Ver sugestões</a>
            <a href="participantes.php">📨 Ver contatos</a>
        </section>

        <section class="dashboard-grid">
            <div class="painel-box-serio">
                <h2>🔥 Palavras mais acessadas</h2>
                <?php if ($mais_acessadas && $mais_acessadas->num_rows > 0) { ?>
                    <?php while($p = $mais_acessadas->fetch_assoc()) { ?>
                        <?php $porcentagem = ((int)$p['visualizacoes'] / $maximo) * 100; ?>
                        <div class="ranking-item">
                            <div class="ranking-top"><strong><?= h($p['palavra']); ?></strong><span><?= h($p['visualizacoes']); ?> acessos</span></div>
                            <div class="barra"><div class="progresso" style="width: <?= $porcentagem; ?>%"></div></div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="vazio-dashboard">Nenhuma palavra acessada ainda.</p>
                <?php } ?>
            </div>

            <div class="painel-box-serio">
                <h2>📨 Últimos contatos</h2>
                <?php if ($ultimos_contatos && $ultimos_contatos->num_rows > 0) { ?>
                    <?php while($c = $ultimos_contatos->fetch_assoc()) { ?>
                        <div class="linha-info">
                            <div><strong><?= h($c['nome_completo']); ?></strong><p><?= h($c['comentario']); ?></p><small><?= h($c['email']); ?></small></div>
                            <small><?= h($c['data_envio']); ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="vazio-dashboard">Nenhuma mensagem recebida ainda.</p>
                <?php } ?>
            </div>
        </section>

        <section class="dashboard-grid dashboard-grid-baixo">
            <div class="painel-box-serio">
                <h2>📚 Últimas palavras cadastradas</h2>
                <div class="tabela-responsiva">
                    <table class="tabela-dashboard">
                        <thead><tr><th>Palavra</th><th>Categoria</th></tr></thead>
                        <tbody>
                        <?php while($u = $ultimas_palavras->fetch_assoc()) { ?>
                            <tr><td><?= h($u['palavra']); ?></td><td><span class="badge-tecnologia"><?= h($u['categoria']); ?></span></td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="painel-box-serio">
                <h2>💡 Últimas sugestões</h2>
                <?php if ($ultimas_sugestoes && $ultimas_sugestoes->num_rows > 0) { ?>
                    <?php while($s = $ultimas_sugestoes->fetch_assoc()) { ?>
                        <div class="linha-info"><div><strong><?= h($s['palavra_sugerida']); ?></strong><p><?= h($s['descricao']); ?></p></div><small><?= h($s['data_envio']); ?></small></div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="vazio-dashboard">Nenhuma sugestão recebida ainda.</p>
                <?php } ?>
            </div>
        </section>
    </main>
</div>
<script src="js/acessibilidade.js?v=700"></script>
<script>
function toggleSidebar(){
    document.body.classList.toggle('sidebar-fechada');
    localStorage.setItem('sidebarFechada', document.body.classList.contains('sidebar-fechada') ? 'sim' : 'nao');
}
if(localStorage.getItem('sidebarFechada') === 'sim'){
    document.body.classList.add('sidebar-fechada');
}
</script>
</body>
</html>
