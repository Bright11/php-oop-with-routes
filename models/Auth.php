<?php

require_once __DIR__ . '/../core/Database.php';


class Auth extends Database
{
    private $table = "users_auth";

    public function findUserByUsername($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch();
    }

    public function createUser($name, $password, $email)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, password, email) VALUES (?, ?, ?)");
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$name, $hashed, $email]);
    }
}
