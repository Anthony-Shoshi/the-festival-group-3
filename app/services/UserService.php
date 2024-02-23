<?php
namespace App\Services;

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
}