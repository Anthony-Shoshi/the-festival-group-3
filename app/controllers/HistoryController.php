<?php
namespace App\Controllers;
use App\Services\HistoryService;
use App\Services\PageService;
use Exception;

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

            $header = $this->historyService->getHeader();
            $introduction = $this->historyService->getIntroduction();
            $information = $this->historyService->getTourInfo();
            $routes = $this->historyService->getRoute();
            $regularTicket = $this->historyService->getRegularTicketPrice();
            $familyTicket = $this->historyService->getFamilyTicketPrice();

            require_once __DIR__ . '/../views/frontend/history/index.php';
        }catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
