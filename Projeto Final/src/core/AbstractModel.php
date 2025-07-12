<?php

abstract class AbstractModel
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        // Conexão com o banco (SQLite no caso)
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../database/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para listar todos os registros
    public function listar()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um registro pelo ID
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para inserir um novo registro
    public function inserir(array $dados)
    {
        // Cria a string de colunas e valores para a query
        $colunas = implode(', ', array_keys($dados));
        $valores = implode(', ', array_map(fn($k) => ":$k", array_keys($dados)));

        $sql = "INSERT INTO {$this->table} ($colunas) VALUES ($valores)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    // Método para atualizar um registro
    public function atualizar($id, array $dados)
    {
        // Cria a string de SET para a query
        $set = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($dados)));
        $dados['id'] = $id; // Adiciona o ID para o WHERE

        $sql = "UPDATE {$this->table} SET $set WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($dados);
    }

    // Método para excluir um registro
    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
