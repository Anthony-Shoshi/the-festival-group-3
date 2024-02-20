<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo "Hello world Anthony!";
    }
    public function create()
    {
        $data = [12, 22, 14, 54, 92];
        require '../views/backend/users/create.php';
    }
}
