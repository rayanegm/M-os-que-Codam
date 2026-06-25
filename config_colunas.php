<?php
/*
  Executa ajustes seguros no banco para manter o site funcionando.
  Pode ser incluído nas páginas principais sem apagar dados.
*/
if (isset($conexao)) {
    $conexao->query("ALTER TABLE palavras ADD COLUMN IF NOT EXISTS visualizacoes INT DEFAULT 0");
    $conexao->query("ALTER TABLE palavras ADD COLUMN IF NOT EXISTS descricao_sinal TEXT NULL");
    $conexao->query("ALTER TABLE palavras ADD COLUMN IF NOT EXISTS codigo TEXT NULL");
    $conexao->query("ALTER TABLE palavras ADD COLUMN IF NOT EXISTS categoria VARCHAR(100) DEFAULT 'Programação'");
    $conexao->query("ALTER TABLE palavras ADD COLUMN IF NOT EXISTS nivel VARCHAR(30) DEFAULT 'Iniciante'");
}
?>
