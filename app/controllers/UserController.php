<?php
namespace App\Controllers;
use App\Models\User;
use App\services\UserService;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/UserService.php';

class UserController
{
    private UserService $loginService;
    public function __construct()
    {
        $this->loginService = new UserService();
    }
    public function login(){
//        session_start();
        if(isset($_POST['login-button']) && isset($_POST['username']) && isset($_POST['password'])){
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->loginService->authenticateUser($username, $password);
            if($user){
                $_SESSION['user'] = $user;
                $_SESSION['username'] = $user['name'];
                require __DIR__ . '/../views/Home.php';
                exit();
            }else{
                echo "Invalid username or password";
            }
            require_once __DIR__ . '/../views/login.php';
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}