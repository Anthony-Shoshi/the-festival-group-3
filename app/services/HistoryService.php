<?php

namespace App\Services;

use App\Repositories\HistoryRepository;
use Exception;

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
    public function getTourLocationById($id)
    {
        return $this->historyRepository->getTourLocationById($id);
    }
    public function getAllTimeSlots()
    {
        return $this->historyRepository->getAllTimeSlots();
    }

    public function addLocation($location)
    {
        try {
            return $this->historyRepository->addLocation($location);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function updateLocation($location, $id)
    {
        try {
            return $this->historyRepository->updateLocation($location, $id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function deleteLocation($id)
    {
        try {
            return $this->historyRepository->deleteLocation($id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getAllContent(){
        try{
            return $this->historyRepository->getAllContent();
        }catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getContentById($id){
        try{
            return $this->historyRepository->getContentById($id);
        }catch (Exception $e){
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function deleteContent($id){
        try{
            return $this->historyRepository->deleteContent($id);
        }catch (Exception $e){
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function addContent($content){
        try{
            return $this->historyRepository->addContent($content);
        }catch (Exception $e){
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function updateContent($content, $id){
        try{
            return $this->historyRepository->updateContent($content, $id);
        }catch (Exception $e){
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}