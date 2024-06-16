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

            $headers = $this->historyService->getHistoryPageInfoBySectionType(SectionType::Header);
            $introduction = $this->historyService->getHistoryPageInfoBySectionType(SectionType::Introduction);
            $information = $this->historyService->getHistoryPageInfoBySectionType(SectionType::Information);
            $regularTickets = $this->historyService->getHistoryPageInfoBySectionType(SectionType::RegularTicket);
            $familyTickets = $this->historyService->getHistoryPageInfoBySectionType(SectionType::FamilyTicket);
            $routes = $this->historyService->getHistoryPageInfoBySectionType(SectionType::Routes);
            require_once __DIR__ . '/../views/frontend/history/index.php';
        }catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
