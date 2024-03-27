<?php

namespace App\Controllers;

use App\Services\PageService;

class HomeController
{
    protected $pageService;

    public function __construct()
    {
        $this->pageService = new PageService();
    }

    public function index()
    {

        require __DIR__ . '/../views/frontend/home.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            require __DIR__ . '/../views/backend/home.php';
        } else {
            require __DIR__ . '/../views/frontend/home.php';
        }
    }

    public function overview()
    {
        require __DIR__ . '/../views/frontend/overview.php';
    }

    public function create()
    {
        require '../views/backend/users/create.php';
    }
    public function footer()
    {

    }
}
