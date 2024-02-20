<?php

class UserRepository
{
    private $db;

    public function __construct()
    {
        include '../config/dbconfig.php';
        $this->db = new PDO(
            "$type:host=$servername;dbname=$dbname",
            $username,
            $password
        );
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Models\User');
        $users = $stmt->fetchAll();
        return $users;
    }

    public function insert($article)
    {
        $stmt = $this->db->prepare("INSERT INTO users
        (id, username, profileImage, email, userRole, password)
        VALUES (:id, :username, :profileImage, :email, :userRole, :password)");
        $results = $stmt->execute([
            ':id' => $article->id,
            ':username' => $article->username,
            ':profileImage' => $article->profileImage,
            ':email' => $article->email,
            ':userRole' => $article->userRole,
            ':password' => $article->password
        ]);
        return $results;
    }
}
