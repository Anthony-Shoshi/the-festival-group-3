<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Dance;
use App\Services\DanceService;

use Exception;

class DanceController
{
    public function index()
    {
        require __DIR__ . '/../views/frontend/dance/index.php';
    }
}