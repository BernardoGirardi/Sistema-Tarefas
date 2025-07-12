<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h2>Menu</h2>
        <nav>
            <a class="btn" href="?rota=usuarios">Listar Usuários</a>
            <a class="btn" href="?rota=tarefas">Listar Tarefas</a>
        </nav>
    </aside>

    <main class="main-content">
        <h1>Editar Tarefa</h1>

        <!-- Formulário de edição -->
        <form method="POST">
            <label>Nome da Tarefa:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($tarefa['nome']) ?>" required>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?= htmlspecialchars($tarefa['descricao']) ?>" required>

            <label>Prioridade:</label>
            <select name="prioridade" required>
                <option value="baixa" <?= $tarefa['prioridade'] === 'baixa' ? 'selected' : '' ?>>Baixa</option>
                <option value="media" <?= $tarefa['prioridade'] === 'media' ? 'selected' : '' ?>>Média</option>
                <option value="alta" <?= $tarefa['prioridade'] === 'alta' ? 'selected' : '' ?>>Alta</option>
            </select>

            <label>Responsável (ID):</label>
            <input type="number" name="responsavel_id" value="<?= htmlspecialchars($tarefa['responsavel_id']) ?>" required>

            <button type="submit">Atualizar</button>
            <a href="?rota=tarefas" class="btn-voltar">Voltar</a>
        </form>
    </main>
</div>

</body>
</html>
