<?php
// src/models/TarefaModel.php

class TarefaModel
{
    protected $pdo;
    protected $table = 'tarefas';

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../database/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para listar tarefas com filtros, trazendo nome do responsável
    public function listarComFiltros($filtros = [])
    {
        $sql = "
            SELECT 
                t.id, 
                t.nome, 
                t.prioridade, 
                t.descricao, 
                t.responsavel_id,
                r.nome AS responsavel_nome
            FROM {$this->table} t
            LEFT JOIN responsaveis r ON t.responsavel_id = r.id
            WHERE 1=1
        ";

        $params = [];

        if (isset($filtros['nome']) && $filtros['nome'] !== '') {
            $sql .= " AND t.nome LIKE :nome";
            $params[':nome'] = '%' . $filtros['nome'] . '%';
        }

        if (isset($filtros['prioridade']) && $filtros['prioridade'] !== '') {
            $sql .= " AND t.prioridade = :prioridade";
            $params[':prioridade'] = $filtros['prioridade'];
        }

        if (isset($filtros['responsavel_id']) && $filtros['responsavel_id'] !== '') {
            $sql .= " AND t.responsavel_id = :responsavel_id";
            $params[':responsavel_id'] = $filtros['responsavel_id'];
        }

        $sql .= " ORDER BY t.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir(array $dados)
    {
        $sql = "INSERT INTO {$this->table} (nome, prioridade, descricao, responsavel_id) 
                VALUES (:nome, :prioridade, :descricao, :responsavel_id)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, array $dados)
    {
        $sql = "UPDATE {$this->table} 
                SET nome = :nome, prioridade = :prioridade, descricao = :descricao, responsavel_id = :responsavel_id 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $dados['id'] = $id;

        return $stmt->execute($dados);
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
