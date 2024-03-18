<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            require __DIR__ . '/../views/backend/home.php';
        } else {
            require __DIR__ . '/../views/frontend/home.php';
        }
    }

    public function overview() {
        require __DIR__ . '/../views/frontend/overview.php';
    }

    public function create()
    {
        $data = [12, 22, 14, 54, 92];
        require '../views/backend/users/create.php';
    }
    

}
