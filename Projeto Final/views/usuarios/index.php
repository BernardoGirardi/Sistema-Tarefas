<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
    <!-- Conteúdo principal -->
    <main class="main-content">
        <h1>Lista de Usuários</h1>

        <a href="?rota=cadastrar-usuario" class="btn criar-btn">Criar Usuário</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <!-- Email removido, pois a tabela responsaveis não possui essa coluna -->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td>
                            <a href="?rota=editar-usuario&id=<?= $usuario['id'] ?>" class="btn editar-btn">Editar</a>
                            <a href="?rota=excluir-usuario&id=<?= $usuario['id'] ?>" class="btn excluir-btn" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
