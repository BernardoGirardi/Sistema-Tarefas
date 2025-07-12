<!-- views/tarefas/cadastrar.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Tarefa</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h2>Menu</h2>
        <nav>
            <a class="btn" href="?rota=tarefas">Listar Tarefas</a>
            <a class="btn" href="?rota=cadastrar-tarefa">Cadastrar Tarefa</a>
        </nav>
    </aside>

    <main class="main-content">
        <h1>Cadastrar Nova Tarefa</h1>

        <form method="POST">
            <div>
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" name="nome" id="nome" required />
            </div>

            <div>
                <label for="prioridade">Prioridade:</label>
                <select name="prioridade" id="prioridade" required>
                    <option value="baixa">Baixa</option>
                    <option value="media">Média</option>
                    <option value="alta">Alta</option>
                </select>
            </div>

            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" required></textarea>
            </div>

            <div>
                <label for="responsavel_id">Responsável (ID):</label>
                <input type="number" name="responsavel_id" id="responsavel_id" />
            </div>

            <div>
                <button type="submit">Salvar</button>
            </div>
        </form>
    </main>
</div>

</body>
</html>
