<?php
// src/models/UserModel.php

class UserModel
{
    protected $pdo;
    protected $table = 'responsaveis';

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
        $sql = "INSERT INTO {$this->table} (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->pdo->prepare($sql);

        if (isset($dados['senha'])) {
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }

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
        // Monta a query dinamicamente para atualizar a senha somente se enviada
        $sql = "UPDATE {$this->table} SET nome = :nome, email = :email";
        if (isset($dados['senha'])) {
            $sql .= ", senha = :senha";
            // Já deve vir com hash do controller, mas se quiser, pode hash aqui também
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        // Monta os parâmetros para execute
        $params = [
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':id' => $id
        ];

        if (isset($dados['senha'])) {
            $params[':senha'] = $dados['senha'];
        }

        return $stmt->execute($params);
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
