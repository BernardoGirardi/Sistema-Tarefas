<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Tarefas</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
    <main class="main-content">
        <h1>Lista de Tarefas</h1>

        <!-- Filtros -->
        <form method="GET" class="filters-form">
            <div>
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>" />
            </div>
            <div>
                <label for="prioridade">Prioridade:</label>
                <select name="prioridade" id="prioridade">
                    <option value="">Todas</option>
                    <option value="baixa" <?= isset($_GET['prioridade']) && $_GET['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                    <option value="media" <?= isset($_GET['prioridade']) && $_GET['prioridade'] == 'media' ? 'selected' : '' ?>>Média</option>
                    <option value="alta" <?= isset($_GET['prioridade']) && $_GET['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
                </select>
            </div>
            <div>
                <label for="responsavel_id">Responsável (ID):</label>
                <input type="text" name="responsavel_id" id="responsavel_id" value="<?= htmlspecialchars($_GET['responsavel_id'] ?? '') ?>" />
            </div>
            <div>
                <button type="submit">Filtrar</button>
            </div>
        </form>

        <a href="?rota=cadastrar-tarefa" class="btn criar-btn">Criar Tarefa</a>

        <!-- Tabela de Tarefas -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Prioridade</th>
                    <th>Descrição</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarefas as $tarefa): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarefa['id']) ?></td>
                        <td><?= htmlspecialchars($tarefa['nome']) ?></td>
                        <td><?= htmlspecialchars($tarefa['prioridade']) ?></td>
                        <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                        <td><?= htmlspecialchars($tarefa['responsavel_id']) ?></td>
                        <td class="button-group">
                            <a href="?rota=editar-tarefa&id=<?= $tarefa['id'] ?>" class="btn editar-btn">Editar</a>
                            <a href="?rota=excluir-tarefa&id=<?= $tarefa['id'] ?>" 
                               class="btn excluir-btn"
                               onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
