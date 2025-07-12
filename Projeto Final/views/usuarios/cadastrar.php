<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h2>Menu</h2>
        <nav>
            <a class="btn" href="?rota=tarefas">Listar Tarefas</a>
            <a class="btn" href="?rota=usuarios">Listar Usuários</a>
        </nav>
    </aside>

    <main class="main-content">
        <h1>Cadastrar Novo Usuário</h1>

        <!-- Formulário de cadastro -->
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Salvar</button>
            <a href="?rota=usuarios" class="btn-voltar">Voltar</a>
        </form>
    </main>
</div>

</body>
</html>
