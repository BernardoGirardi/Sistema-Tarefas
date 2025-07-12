<?php

$pdo = new PDO('sqlite:' . __DIR__ . '/../migrations/database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Prepara o insert para responsáveis
    $stmtResponsavel = $pdo->prepare("INSERT INTO responsaveis (nome, email, senha) VALUES (:nome, :email, :senha)");

    // Dados dos responsáveis com email e senha (a senha será hash da string '123456' só como exemplo)
    $responsaveis = [
        ['nome' => 'Bernardo Girardi', 'email' => 'bernardo@example.com', 'senha' => password_hash('123456', PASSWORD_DEFAULT)],
        ['nome' => 'Maria Souza', 'email' => 'maria@example.com', 'senha' => password_hash('123456', PASSWORD_DEFAULT)],
        ['nome' => 'Carlos Oliveira', 'email' => 'carlos@example.com', 'senha' => password_hash('123456', PASSWORD_DEFAULT)],
    ];

    // Inserir responsáveis
    foreach ($responsaveis as $resp) {
        $stmtResponsavel->execute([
            ':nome' => $resp['nome'],
            ':email' => $resp['email'],
            ':senha' => $resp['senha'],
        ]);
    }

    // Insert algumas tarefas vinculando os responsáveis
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Comprar materiais', 'alta', 'Comprar papel e canetas', 1)");
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Reunião com cliente', 'media', 'Discussão do projeto X', 2)");
    $pdo->exec("INSERT INTO tarefas (nome, prioridade, descricao, responsavel_id) VALUES ('Enviar relatório', 'baixa', 'Enviar relatório mensal', 3)");

    echo "Dados inseridos com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage() . "\n";
}
