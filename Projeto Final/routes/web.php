// routes/web.php

<?php

$rota = $_GET['rota'] ?? 'tarefas';

switch ($rota) {
    case 'tarefas':
        require_once __DIR__ . '/../src/controllers/TarefaController.php';
        $controller = new TarefaController();
        $conteudo = $controller->index();
        break;

    case 'cadastrar-tarefa':
        require_once __DIR__ . '/../src/controllers/TarefaController.php';
        $controller = new TarefaController();
        $conteudo = $controller->cadastrar();
        break;

    case 'editar-tarefa':
        require_once __DIR__ . '/../src/controllers/TarefaController.php';
        $controller = new TarefaController();
        $conteudo = $controller->editar();
        break;

    case 'excluir-tarefa':
        require_once __DIR__ . '/../src/controllers/TarefaController.php';
        $controller = new TarefaController();
        $conteudo = $controller->excluir();
        break;

    case 'usuarios':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        $controller = new UserController();
        $conteudo = $controller->index();
        break;

    case 'cadastrar-usuario':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        $controller = new UserController();
        $conteudo = $controller->cadastrar();
        break;

    case 'editar-usuario':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        $controller = new UserController();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $conteudo = $controller->editar($id);
        }
        break;

    case 'excluir-usuario':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        $controller = new UserController();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $conteudo = $controller->excluir($id);
        } else {
            echo "ID do usuário não informado.";
        }
        break;

    default:
        $conteudo = 'Página não encontrada.';
}

include __DIR__ . '/../public/index.php';
