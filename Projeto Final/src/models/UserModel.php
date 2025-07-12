<?php
// src/models/UserModel.php

class UserModel
{
    protected $pdo;
    protected $table = 'responsaveis'; // ← Agora usa a tabela correta

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../database/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function listar()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir(array $dados)
    {
        $sql = "INSERT INTO {$this->table} (nome) VALUES (:nome)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
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
        $sql = "UPDATE {$this->table} SET nome = :nome WHERE id = :id";
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
