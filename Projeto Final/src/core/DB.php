<?php
try {
    $dbPath = __DIR__ . '/../../database/tarefas.sqlite';
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        CREATE TABLE IF NOT EXISTS tarefas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            prioridade TEXT NOT NULL,
            descricao TEXT,
            responsavel TEXT
        );
    ";

    $pdo->exec($sql);
    echo "Banco e tabela criados com sucesso!";
} catch (PDOException $e) {
    die("Erro na criação do banco: " . $e->getMessage());
}
