<?php
namespace App\Services;
use App\Repositories\HistoryRepository;
class HistoryService
{
    private HistoryRepository $historyRepository;
    public function __construct()
    {
        $this->historyRepository = new HistoryRepository();
    }
    public function getAllTourLocations()
    {
        return $this->historyRepository->getAllTourLocations();
    }
}