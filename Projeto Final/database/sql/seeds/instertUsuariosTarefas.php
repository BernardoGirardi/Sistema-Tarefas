<?php
// database/seed.php

$pdo = new PDO('sqlite:' . __DIR__ . '/../migrations/database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Insert alguns responsáveis
    $pdo->exec("INSERT INTO responsaveis (nome) VALUES ('Bernardo Girardi')");
    $pdo->exec("INSERT INTO responsaveis (nome) VALUES ('Maria Souza')");
    $pdo->exec("INSERT INTO responsaveis (nome) VALUES ('Carlos Oliveira')");

    // Insert algumas tarefas vinculando os responsáveis
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Comprar materiais', 'alta', 'Comprar papel e canetas', 1)");
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Reunião com cliente', 'media', 'Discussão do projeto X', 2)");
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Enviar relatório', 'baixa', 'Enviar relatório mensal', 3)");

    echo "Dados inseridos com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage() . "\n";
}

?>