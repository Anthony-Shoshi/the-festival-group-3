<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use PDO;

class UserService
{
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticateUser($username, $password)
    {
        $user = $this->userRepository->authenticateUser($username, $password);
        if ($user) {
            return $user;
        }
        return null;
    }

    public function getAllUsers()
    {
        try {
            return $this->userRepository->getAllUsers();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    
    public function storeUser(User $user)
    {
        try {
            return $this->userRepository->storeUser($user);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getUserById($userId)
    {
        try {
            return $this->userRepository->getUserById($userId);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateUser($user)
    {
        try {
            return $this->userRepository->updateUser($user);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function deleteUser($userId)
    {
        try {
            return $this->userRepository->deleteUser($userId);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
