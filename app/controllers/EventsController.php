<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Events;
use App\Models\EventTypes;
use App\Services\EventService;
use Exception;

class EventsController{
    private EventService $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }
    public function index()
    {
        try {
            $events = $this->eventService->getAll();
            require __DIR__ . '/../views/backend/events/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function create()
    {
        $eventtypes = EventTypes::getEnumValues();
        require '../views/backend/events/create.php';
    }

    public function edit()
    {
        $event_id = $_GET['id'];
        $eventtypes = EventTypes::getEnumValues();
        $event = $this->eventService->getEventById($event_id);
        require __DIR__ . '/../views/backend/events/edit.php';
    }

    public function store()
    {
        require __DIR__ . '/../views/backend/events/store.php';
    }

    public function update()
    {
        require __DIR__ . '/../views/backend/events/update.php';
    }
}