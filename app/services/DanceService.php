<?php
namespace App\Services;

use App\Models\Dance;
use App\Repositories\DanceRepository;
use Exception;

class DanceService
{
    private DanceRepository $danceRepository;

    public function __construct()
    {
        $this->danceRepository = new DanceRepository();
    }

    public function getAllEvents()
    {
        try {
            return $this->danceRepository->getAll();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getArtistIdsByEventId(int $music_event_id){
        try {
            return $this->danceRepository->getArtistIdsByEventId($music_event_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getDanceEventById(int $music_performance_id)
    {
        try {
            return $this->danceRepository->getDanceEventById($music_performance_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function updateDance(Dance $dance, $dance_id): bool
    {
        try {
            return $this->danceRepository->update($dance, $dance_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function storeDance(Dance $dance)
    {
        try {
            return $this->danceRepository->storeDance($dance);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function deleteDance($dance_id)
    {
        try {
            return $this->danceRepository->deleteDance($dance_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getAllPasses()
    {
        try {
            return $this->danceRepository->getAllPasses();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}