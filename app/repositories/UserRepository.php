<?php

namespace App\Repositories;

use App\Models\Role;
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

    public function registerUser($newUser): bool
    {
        try {
            $sql = "INSERT INTO users (name, email, password, role, profile_picture) 
                VALUES (:name, :email, :password, :role, :profile_picture)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $newUser['name']);
            $stmt->bindValue(':email', $newUser['email']);
            $stmt->bindValue(':password', $newUser['password']);
            $stmt->bindValue(':role',Role::getLabel($newUser['role']) );
            $stmt->bindValue(':profile_picture', $newUser['profile_picture']);
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    private function checkUserExistence($stmt): bool
    {
        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e;
            exit();
        }
    }

    public function checkUserExistenceByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT user_id From users WHERE email= :email");
            $stmt->bindValue(':email', $email);
            if ($this->checkUserExistence($stmt)) {
                $stmt->execute();
                $result = $stmt->fetch();
                return $result[0];
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
