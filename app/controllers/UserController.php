<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use App\services\UserService;
use Exception;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/UserService.php';

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        session_start();
        $this->userService = new UserService();
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        require __DIR__ . '/../views/backend/users/index.php';
    }

    public function create()
    {
        $roles = Role::getEnumValues();
        require __DIR__ . '/../views/backend/users/create.php';
    }

    public function store()
    {
        try {
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
                $imageUrl = '';
            }

            $user = new User();
            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->setRole($_POST['role']);
            $user->setProfilePicture($imageUrl);

            $this->userService->storeUser($user);

            header("Location: /user");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function getUser($userId)
    {
        try {
            $user = $this->userService->getUserById($userId);
            header("Location: /user/" . $userId);
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit()
    {
        $userId = $_GET['id'];
        if (isset($userId) && $userId > 0) {
            $user = $this->userService->getUserById($userId);
            require __DIR__ . '/../views/backend/users/edit.php';
        } else {
            header("Location: /error?message=something went wrong with this user data!");
            exit();
        }
    }

    public function update()
    {
        try {
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $newFileName = uniqid('', true) . '_' . $_FILES['profile_picture']['name'];
                $uploadFile = __DIR__ . '/../public/backend/img/' . $newFileName;

                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $allowedExtensions)) {
                    throw new Exception('Invalid file format. Please upload a valid image file.');
                }

                if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
                    throw new Exception('Failed to upload profile picture.');
                }

                $userData = [
                    'user_id' => $_POST['user_id'],
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'role' => $_POST['role'],
                    'profile_picture' => '/backend/img/' . $newFileName,
                ];
            } else {
                $userData = [
                    'user_id' => $_POST['user_id'],
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'role' => $_POST['role'],
                    'profile_picture' => '/backend/img/default.jpg',
                ];
            }

            $this->userService->updateUser($userData);
            header("Location: /user");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }


    // public function update()
    // {
    //     try {
    //         $userData = [
    //             'user_id' => $_POST['user_id'],
    //             'name' => $_POST['name'],
    //             'email' => $_POST['email'],
    //             'role' => $_POST['role'],
    //         ];

    //         $this->userService->updateUser($userData);

    //         header("Location: /user");
    //         exit();
    //     } catch (Exception $e) {
    //         // Redirect to error page with error message
    //         header("Location: /error?message=" . urlencode($e->getMessage()));
    //         exit();
    //     }
    // }

    public function delete()
{
    $userId = $_GET['id'];
    if (isset($userId) && $userId > 0) {
        $user = $this->userService->getUserById($userId);
        $this->userService->deleteUser($userId);
        header("Location: /user");
        exit();
    } else {
        header("Location: /error?message=something went wrong with this user data!");
        exit();
    }
}

    //    public function login(){
    ////        session_start();
    //        if(isset($_POST['login-button']) && isset($_POST['username']) && isset($_POST['password'])){
    //            $username = htmlspecialchars($_POST['username']);
    //            $password = htmlspecialchars($_POST['password']);
    //            $user = $this->loginService->authenticateUser($username, $password);
    //            if($user){
    //                $_SESSION['user'] = $user;
    //                $_SESSION['username'] = $user['name'];
    //                require __DIR__ . '/../views/Home.php';
    //                exit();
    //            }else{
    //                echo "Invalid username or password";
    //            }
    //            require_once __DIR__ . '/../views/login.php';
    //        } else {
    //            require_once __DIR__ . '/../views/login.php';
    //        }
    //    }
}
