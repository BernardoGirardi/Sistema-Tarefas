<?php

$pdo = new PDO('sqlite:' . __DIR__ . '/../../database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Cria a tabela de responsáveis
$pdo->exec("
    CREATE TABLE IF NOT EXISTS responsaveis (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL,
        senha TEXT NOT NULL
    );
");

// Cria a tabela de tarefas com a coluna responsavel_id
$pdo->exec("
    CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        prioridade TEXT NOT NULL,
        descricao TEXT,
        responsavel_id INTEGER,
        FOREIGN KEY (responsavel_id) REFERENCES responsaveis(id)
    );
");

echo "Banco de dados criado com sucesso.\n";
