<?php
namespace App\Controllers;
use App\Services\HistoryService;
class HistoryController
{
    private HistoryService $historyService;
    public function __construct()
    {
        $this->historyService = new HistoryService();
    }
    public function index()
    {
        try{
            $locations = $this->historyService->getAllTourLocations();
            require_once __DIR__ . '/../views/backend/history/index.php';
        }catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function edit()
    {
        require_once __DIR__ . '/../views/backend/history/edit.php';
    }
}

