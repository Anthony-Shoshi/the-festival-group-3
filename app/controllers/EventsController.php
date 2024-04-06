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
        try {
            $imageUrl = null;

            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image_url'];
                $fileName = $file['name'];
                $newFileName = uniqid('', true) . '_' . $fileName;
                $uploadFile = __DIR__ . '/../public/images/' . $newFileName;

                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($imageFileType, $allowedExtensions)) {
                    throw new Exception('Invalid file format. Please upload a valid image file.');
                }

                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception('Failed to upload image.');
                }

                $imageUrl = $newFileName;
            }
            $event = new Events();
            $event->setEventType($_POST['event_type']);
            $event->setEventTitle($_POST['title']);
            $event->setEventDescription($_POST['description']);
            $event->setEventStartDate($_POST['start_date']);
            $event->setEventEndDate($_POST['end_date']);
            $event->setPrimaryThemeColor($_POST['primary_theme_color']);
            $event->setSecondaryThemeColor($_POST['secondary_theme_color']);
            $event->setEventImage($imageUrl);

            $this->eventService->storeEvent($event);

            header("Location: /events");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function delete()
    {
        $eventId = $_GET['id'];
        if (isset($eventId) && $eventId > 0) {
            $artist = $this->eventService->getEventById($eventId);
            $this->eventService->deleteEvent($eventId);
            header("Location: /events");
            exit();
        } else {
            header("Location: /error?message=something went wrong with this user data!");
            exit();
        }
    }

    public function update()
    {
        try {
            $event_id = $_POST['event_id'];
            $status = 1;

            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {

                $newFileName = uniqid('', true) . '_' . $_FILES['image_url']['name'];
                $uploadFile = __DIR__ . '/../public/images/' . $newFileName;

                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array($imageFileType, $allowedExtensions)) {
                    throw new Exception('Invalid file format. Please upload a valid image file.');
                }

                if (!move_uploaded_file($_FILES['image_url']['tmp_name'], $uploadFile)) {
                    throw new Exception('Failed to upload image.');
                }

                $image_url = $newFileName;
            } else {
                $event = $this->eventService->getEventById($event_id);
                $image_url = $event['image_url'];
            }

            $event = new Events(
                (int)$_POST['event_id'],
                $_POST['event_type'],
                $_POST['title'],
                $_POST['description'],
                $_POST['start_date'],
                $_POST['end_date'],
                $_POST['primary_theme_color'],
                $_POST['secondary_theme_color'],
                $status,
                $image_url
            );

            $this->eventService->updateEvent($event, $event_id);

            $_SESSION['isError'] = 0;
            $_SESSION['flash_message'] = "Event updated successfully!";
            header("Location: /events");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}