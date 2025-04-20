<?php

require_once __DIR__ . '/../core/Database.php';


class User extends Database
{
    private $table = "users";



    public function getAllUsers()
    {
        $stmt = $this->conn->query("SELECT * FROM $this->table ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createUser($name, $email, $photo)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, email, photo) VALUES (?, ?,?)");
        return $stmt->execute([$name, $email, $photo]);
    }

    public function updateUser($id, $name, $email, $photo)
    {
        $stmt = $this->conn->prepare("UPDATE $this->table SET name = ?, email = ?, photo=? WHERE id = ?");
        return $stmt->execute([$name, $email, $photo, $id]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getUsersByPage($page = 1, $limit = 5)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->conn->prepare("SELECT * FROM $this->table ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserCount()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM $this->table");
        return $stmt->fetchColumn();
    }
}
