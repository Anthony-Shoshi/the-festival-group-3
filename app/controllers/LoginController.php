<?php

namespace App\Controllers;

use App\Models\User;
use App\services\UserService;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/UserService.php';

class LoginController
{
    private UserService $loginService;
    public function __construct()
    {
        $this->loginService = new UserService();
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location: /");
        exit();
    }
    public function login()
    {        
        if (isset($_POST['login-button']) && isset($_POST['username']) && isset($_POST['password'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->loginService->authenticateUser($username, $password);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                header("location: /");
                exit();
            } else {
                echo "Invalid username or password";
            }
            require_once __DIR__ . '/../views/login.php';
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}
