<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\User;
use mysql_xdevapi\Exception;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    private $db;

    public function getAllUsers()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users");
            $stmt->execute();
            $users = array();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $user) {
                $users[] = $this->createUser($user);
            }
            return $users;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createUser($user)
    {
        try {
            $user = new User();
            $user->setuserid($user['userid']);
            $user->setname($user['name']);
            $user->setemail($user['email']);
            $user->setpassword($user['password']);
            $user->setrole($user['role']);
            $user->setprofilepicture($user['profile_picture']);
            $user->setregistration_date($user['registration_date']);
            return $user;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function authenticateUser($email, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $userRow['password'])) {
                    return $userRow;
                }
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

}
