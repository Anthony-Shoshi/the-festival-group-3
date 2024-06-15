<?php

namespace App\Repositories;

use App\Models\Session;
use Exception;
use PDO;
use PDOException;

class SessionRepository extends Repository
{
    public function getAllSessions()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                sessions.session_id, 
                sessions.start_time, 
                sessions.duration, 
                sessions.sessions_per_day, 
                restaurants.title AS restaurant_title
            FROM sessions
            INNER JOIN restaurants ON sessions.restaurant_id = restaurants.restaurant_id
        ");
            $stmt->execute();
            $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $sessions;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getSessionsByRestaurantId($restaurantId)
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT *
                FROM sessions
                INNER JOIN restaurants ON sessions.restaurant_id = restaurants.restaurant_id
                WHERE sessions.restaurant_id = :restaurant_id
            ");
            $stmt->bindParam(':restaurant_id', $restaurantId, PDO::PARAM_INT);
            $stmt->execute();
            $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $sessions;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    
    public function getAllEvents()
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

    public function createSession(Session $session)
    {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO sessions (restaurant_id, start_time, duration, sessions_per_day)
                VALUES (:restaurant_id, :start_time, :duration, :sessions_per_day)
            ");
            $stmt->execute([
                ':restaurant_id' => $session->getRestaurantId(),
                ':start_time' => $session->getStartTime(),
                ':duration' => $session->getDuration(),
                ':sessions_per_day' => $session->getSessionsPerDay()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getSession($session_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM sessions WHERE session_id = :session_id");
            $stmt->bindParam(':session_id', $session_id);
            $stmt->execute();
            $sessionRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $sessionRow;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateSession(Session $session)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE sessions SET 
                    restaurant_id = :restaurant_id,
                    start_time = :start_time,
                    duration = :duration,
                    sessions_per_day = :sessions_per_day
                WHERE session_id = :session_id
            ");
            $stmt->execute([
                ':session_id' => $session->getSessionId(),
                ':restaurant_id' => $session->getRestaurantId(),
                ':start_time' => $session->getStartTime(),
                ':duration' => $session->getDuration(),
                ':sessions_per_day' => $session->getSessionsPerDay()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function deleteSession($session_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM sessions WHERE session_id = :session_id");
            $stmt->bindParam(':session_id', $session_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}

