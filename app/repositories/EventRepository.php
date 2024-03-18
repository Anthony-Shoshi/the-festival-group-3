<?php

namespace App\Repositories;

use App\Models\Events;
use Exception;
use PDO;
use PDOException;

class EventRepository extends Repository{

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM events");
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $events;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getEventById(int $event_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM events WHERE  event_id = :event_id");
            $stmt->bindParam(':event_id', $event_id);
            $stmt->execute();
            $events = $stmt->fetch(PDO::FETCH_ASSOC);
            return $events;
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}