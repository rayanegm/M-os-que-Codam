<?php
session_start();

if (!isset($_SESSION['criador'])) {
    header("Location: login.php");
    exit;
}

include "conexao.php";
include "config_colunas.php";

$total_palavras = $conexao->query("SELECT COUNT(*) AS total FROM palavras")->fetch_assoc();
$total_sugestoes = $conexao->query("SELECT COUNT(*) AS total FROM sugestoes")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Criador</title>
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
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<main class="formulario-card">
    <div class="titulo-palavra">
        <h1>Painel do Criador</h1>
        <p>Cadastre uma palavra como uma mini aula com Libras, explicação e exemplo de código.</p>
    </div>

    <a href="dashboard.php" class="botao-painel">📊 Voltar ao Dashboard</a>

    <div class="sobre-box sugestao-box">
        <h2>➕ Adicionar Palavra</h2>

        <form class="form-sugestao" action="salvar_palavra.php" method="POST">
            <label>Nome da palavra</label>
            <input type="text" name="palavra" placeholder="Ex.: Variável" required>

            <label>Link do vídeo do YouTube</label>
            <input type="text" name="video" placeholder="Cole aqui o link do vídeo em Libras" required>

            <div class="grid-form">
                <div>
                    <label>Categoria</label>
                    <select name="categoria" required>
                        <option value="Lógica de Programação">Lógica de Programação</option>
                        <option value="HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP">PHP</option>
                        <option value="Java">Java</option>
                        <option value="Python">Python</option>
                        <option value="Banco de Dados">Banco de Dados</option>
                        <option value="Front-End">Front-End</option>
                        <option value="Back-End">Back-End</option>
                        <option value="UX/UI">UX/UI</option>
                        <option value="Cloud">Cloud</option>
                    </select>
                </div>

                <div>
                    <label>Nível</label>
                    <select name="nivel" required>
                        <option value="Iniciante">Iniciante</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                </div>
            </div>

            <label>Resumo / significado da palavra</label>
            <textarea name="resumo" placeholder="Explique o significado de forma simples" required></textarea>

            <label>✋ Como fazer o sinal?</label>
            <textarea name="descricao_sinal" placeholder="Descreva em português o movimento do sinal em Libras. Ex.: A mão dominante realiza..." required></textarea>

            <label>💻 Exemplo de código</label>
            <textarea name="codigo" class="campo-codigo" placeholder="Digite um exemplo de código. Ex.: let nome = 'Ana';" required></textarea>

            <label>💬 Explicação do código em português</label>
            <textarea name="exemplo_portugues" placeholder="Explique o que o código faz de forma simples" required></textarea>

            <button type="submit" class="btn-salvar">🚀 Salvar Palavra</button>
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
