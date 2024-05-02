<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\PageService;
use App\Services\RestaurantService;
use App\Services\SectionService;

class HomeController
{
    protected $pageService;
    protected $sectionService;
    protected $restaurantService;

    public function __construct()
    {
        $this->pageService = new PageService();
        $this->sectionService = new SectionService();
        $this->restaurantService = new RestaurantService();
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

    public function page()
    {
        $id = $_GET['id'];
        $slug = $_GET['slug'];
        $sections = $this->sectionService->getSectionByPageId($id);        
        switch ($slug) {
            case 'history':
                require '../views/frontend/history/index.php';
                break;
            case 'yummy':
                $restaurants = $this->restaurantService->getAllRestaurants();
                require '../views/frontend/yummy/index.php';
                break;
            default:
                require '../views/frontend/custom.php';
                break;
        }
    }
}
