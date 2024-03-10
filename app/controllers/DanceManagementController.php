<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Dance;
use App\Services\DanceService;
use Exception;
class DanceManagementController{
    private DanceService $danceService;

    public function __construct()
    {
        $this->danceService = new DanceService();
    }


    public function index()
    {
        try {
            $venues = $this->danceService->getAllEvents();
            require __DIR__ . '/../views/backend/danceManagement/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

}