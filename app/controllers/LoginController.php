<?php

namespace App\Controllers;
use App\Models\Role;

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

    private function createNewUser(): void
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $picture = $_FILES['profile_picture'];
        $role = Role::Customer();

        if(!empty($name) && !empty($email) && !empty($password)){
            $newUser = array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'profile_picture' => $picture,
                'role' => $role
            );
            $success=$this->loginService->registerUser($newUser);
            if($success){
                require_once __DIR__ . '/../views/login.php';
                exit();
            }else{
                echo "Failed to create user";
                require_once __DIR__ . '/../views/signup.php';
            }


        }
        require __DIR__ . '/../views/signup.php';
    }
    private function registerUser(): void
    {
        if($this->loginService->checkIfUserExists(htmlspecialchars($_POST['email']))){
            echo "User already exists";
        }elseif ($_POST['password'] != $_POST['confirm_password']){
            echo "Passwords do not match";
        }else{
            $this->createNewUser();
        }
    }
    public function signup(){
        $errormessage = "";
        if(isset($_POST['signup-button'])) {
            if(empty($_POST['name'])){
                $errormessage = "Name is required";
            }
            if(empty($_POST['email'])){
                $errormessage = "Email is required";
            }
            if(empty($_POST['password'])){
                $errormessage = "Password is required";
            }
            else{
//                if($this->loginService->captchaVerification($errormessage)) {
                    $this->registerUser();
//                else{
//                    $errormessage = "Captcha verification failed";
//                }
            }
        }
        require __DIR__ . '/../views/Signup.php';
    }

}
