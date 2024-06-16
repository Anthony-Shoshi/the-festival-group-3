<?php
namespace App\Controllers;
use App\Services\HistoryService;
use App\Services\PageService;
use Exception;
use App\Models\SectionType;
class HistoryController
{
    private HistoryService $historyService;
    private PageService $pageService;
    public function __construct()
    {
        $this->historyService = new HistoryService();
        $this->pageService = new PageService();
    }
    public function index()
    {
        try{
            $location = $this->historyService->getAllTourLocations();
            $tours = $this->historyService->getAllTours();
            $pages = $this->pageService->getAllPages();

            require_once __DIR__ . '/../views/frontend/history/index.php';
        }catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
