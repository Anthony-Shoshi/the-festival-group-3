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
            $stmt = $this->connection->prepare("SELECT * FROM sessions");
            $stmt->execute();
            $Sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $Sessions;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createSession(Session $session)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO sessions (total_session, duration, first_session) VALUES (:total_session, :duration, :first_session)");
            $stmt->execute([
                ':total_session' => $session->getTotalSessions(),
                ':duration' => $session->getDuration(),
                ':first_session' => $session->getFirstSession()
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
            $SessionRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $SessionRow;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateSession(Session $session)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE sessions SET total_session = :total_session, duration = :duration, first_session = :first_session WHERE session_id = :session_id");
            $stmt->execute([
                ':session_id' => $session->getSessionId(),
                ':total_session' => $session->getTotalSessions(),
                ':duration' => $session->getDuration(),
                ':first_session' => $session->getFirstSession()
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
