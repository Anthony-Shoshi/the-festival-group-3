<?php

namespace App\Controllers;

use App\Models\Role;

use App\Models\User;
use App\services\UserService;
use Exception;

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
                $_SESSION['user'] = $user;
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                header("location: /");
                exit();
            } else {
                $_SESSION['flash_message'] = "Invalid username or password";
                header("location: /login/login");
                exit();
            }            
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }

    private function createNewUser(): void
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $role = Role::Customer();

        if (isset($_FILES['profile_picture'])) {
            $file = $_FILES['profile_picture'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            if ($fileError === UPLOAD_ERR_OK) {
                $newFileName = uniqid('', true) . '_' . $fileName;
                $uploadPath = __DIR__ . '/../public/backend/img/' . $newFileName;
                move_uploaded_file($fileTmpName, $uploadPath);

                $imageUrl = '/backend/img/' . $newFileName;
            } else {
                throw new Exception('Error uploading file: ' . $fileError);
            }
        } else {
            $imageUrl = '/backend/img/default.jpg';
        }

        if (!empty($name) && !empty($email) && !empty($password)) {
            $newUser = array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'profile_picture' => $imageUrl,
                'role' => $role
            );
            $success = $this->loginService->registerUser($newUser);
            if ($success) {
                $_SESSION['username'] = $name;
                $_SESSION['role'] = $role;
                $_SESSION['profile_picture'] = $imageUrl;
                header("location: /");
                exit();
            } else {
                $_SESSION['flash_message'] = "Failed to create user";
                header("Location: /login/signup");
                exit();
            }
        }
        require __DIR__ . '/../views/signup.php';
    }

    private function registerUser(): void
    {
        if ($this->loginService->checkIfUserExists(htmlspecialchars($_POST['email']))) {
            $_SESSION['flash_message'] = "User already exists";
            header("Location: /login/signup");
            exit();
        } elseif ($_POST['password'] != $_POST['confirm_password']) {
            $_SESSION['flash_message'] = "Passwords do not match";
            header("Location: /login/signup");
            exit();
        } else {
            $this->createNewUser();
        }
    }

    public function signup()
    {
        $errormessage = "";
        if (isset($_POST['signup-button'])) {
            if (empty($_POST['name'])) {
                $_SESSION['flash_message'] = "Name is required";
            } else if (empty($_POST['email'])) {
                $_SESSION['flash_message'] = "Email is required";
            } else if (empty($_POST['password'])) {
                $_SESSION['flash_message'] = "Password is required";
            } else {
                //                if($this->loginService->captchaVerification($errormessage)) {
                $this->registerUser();
                //                else{
                //                    $errormessage = "Captcha verification failed";
                //                }
            }
            header("Location: /login/signup");
            exit();
        } else {
            require_once __DIR__ . '/../views/signup.php';
        }
    }
}
