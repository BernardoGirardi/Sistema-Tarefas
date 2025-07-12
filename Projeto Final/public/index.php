<?php
// public/index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../routes/web.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <nav>
                <a href="?rota=tarefas" class="btn">Listar Tarefas</a>
                <a href="?rota=usuarios" class="btn">Listar Usuários</a>
            </nav>
        </aside>

        <main class="main-content">
            <?= $conteudo ?>  <!-- Aqui será inserido o conteúdo da view -->
        </main>
    </div>
</body>
</html>
