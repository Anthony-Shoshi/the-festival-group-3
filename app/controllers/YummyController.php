<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\RestaurantService;

class YummyController
{
    protected $restaurantService;

    public function __construct()
    {
        $this->restaurantService = new RestaurantService();
    }

    public function index() {
        $restaurants = $this->restaurantService->getAllRestaurants();
        // Helper::debug($restaurants);
        require __DIR__ . '/../views/frontend/yummy.php';
    }
}
