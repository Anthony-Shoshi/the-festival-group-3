<?php
namespace App\Controllers;
use App\Services\HistoryService;
use Exception;

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
            $location = $this->historyService->getAllTourLocations();
            $contents = $this->historyService->getAllContent();
            $tours = $this->historyService->getAllTours();
            require_once __DIR__ . '/../views/frontend/history/index.php';
        }catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
