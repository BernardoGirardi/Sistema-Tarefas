<?php
// src/models/TarefaModel.php

class TarefaModel
{
    protected $pdo;
    protected $table = 'tarefas'; // Nome da tabela no banco de dados

    public function __construct()
    {
        // Caminho para o banco de dados SQLite
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../database/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para listar todas as tarefas com filtros
    public function listarComFiltros($filtros = [])
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";  // 1=1 é uma condição verdadeira para facilitar a adição de outros filtros

        // Adiciona filtros dinâmicos
        if (isset($filtros['nome']) && !empty($filtros['nome'])) {
            $sql .= " AND nome LIKE :nome";
        }
        if (isset($filtros['prioridade']) && !empty($filtros['prioridade'])) {
            $sql .= " AND prioridade = :prioridade";
        }
        if (isset($filtros['responsavel_id']) && !empty($filtros['responsavel_id'])) {
            $sql .= " AND responsavel_id = :responsavel_id";
        }

        $stmt = $this->pdo->prepare($sql);

        // Bind os parâmetros de filtro, se existirem
        if (isset($filtros['nome']) && !empty($filtros['nome'])) {
            $stmt->bindValue(':nome', '%' . $filtros['nome'] . '%');
        }
        if (isset($filtros['prioridade']) && !empty($filtros['prioridade'])) {
            $stmt->bindValue(':prioridade', $filtros['prioridade']);
        }
        if (isset($filtros['responsavel_id']) && !empty($filtros['responsavel_id'])) {
            $stmt->bindValue(':responsavel_id', $filtros['responsavel_id']);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para inserir uma nova tarefa
    public function inserir(array $dados)
    {
        $sql = "INSERT INTO {$this->table} (nome, prioridade, descricao, responsavel_id) 
                VALUES (:nome, :prioridade, :descricao, :responsavel_id)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    // Método para buscar uma tarefa pelo ID
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar uma tarefa
    public function atualizar($id, array $dados)
    {
        $sql = "UPDATE {$this->table} SET nome = :nome, prioridade = :prioridade, descricao = :descricao, responsavel_id = :responsavel_id WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    // Método para excluir uma tarefa
    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
