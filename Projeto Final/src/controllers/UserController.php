<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $usuarios = $this->model->listar();
        require __DIR__ . '/../../views/usuarios/index.php';
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = ['nome' => $_POST['nome'] ?? ''];
            $this->model->inserir($dados);
            header('Location: /?rota=usuarios');
            exit;
        }

        require __DIR__ . '/../../views/usuarios/cadastrar.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = ['nome' => $_POST['nome'] ?? ''];
            $this->model->atualizar($id, $dados);
            header('Location: /?rota=usuarios');
            exit;
        }

        $usuario = $this->model->buscarPorId($id);
        require __DIR__ . '/../../views/usuarios/editar.php';
    }

    public function excluir($id)
    {
        $this->model->deletar($id);
        header('Location: /?rota=usuarios');
        exit;
    }
}
