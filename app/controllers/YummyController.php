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
}
