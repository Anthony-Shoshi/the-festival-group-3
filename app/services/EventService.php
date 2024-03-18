<?php

namespace App\Services;



use App\Models\Events;
use App\Repositories\EventRepository;

class EventService{
    private EventRepository $eventRepository ;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function getAll()
    {
        try {
            return $this->eventRepository->getAll();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getEventById(int $event_id)
    {
        try {
            return $this->eventRepository->getEventById($event_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
