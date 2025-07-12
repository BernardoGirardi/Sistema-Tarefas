<?php
// src/controllers/TarefaController.php

require_once __DIR__ . '/../models/TarefaModel.php';

class TarefaController
{
    private $model;

    public function __construct()
    {
        $this->model = new TarefaModel();
    }

    // Método para listar todas as tarefas com filtros
    public function index()
    {
        $filtros = [
            'nome' => $_GET['nome'] ?? '',
            'prioridade' => $_GET['prioridade'] ?? '',
            'responsavel_id' => $_GET['responsavel_id'] ?? ''
        ];

        $tarefas = $this->model->listarComFiltros($filtros);

        require __DIR__ . '/../../views/tarefas/index.php';
    }

    // Método para cadastrar uma nova tarefa
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => $_POST['nome'] ?? '',
                'prioridade' => $_POST['prioridade'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
                'responsavel_id' => $_POST['responsavel_id'] ?? ''
            ];

            $this->model->inserir($dados);

            // Redireciona para a listagem de tarefas
            header('Location: /?rota=tarefas');
            exit;
        }

        require __DIR__ . '/../../views/tarefas/cadastrar.php';
    }

    // Método para editar uma tarefa
    public function editar()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID da tarefa não fornecido.";
            return;
        }

        $tarefa = $this->model->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => $_POST['nome'] ?? '',
                'prioridade' => $_POST['prioridade'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
                'responsavel_id' => $_POST['responsavel_id'] ?? ''
            ];

            $this->model->atualizar($id, $dados);
            header('Location: /?rota=tarefas');
            exit;
        }

        require __DIR__ . '/../../views/tarefas/editar.php';
    }

    // Método para excluir uma tarefa
    public function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->model->deletar($id);
        }

        // Redireciona para a listagem de tarefas
        header('Location: /?rota=tarefas');
        exit;
    }
}
