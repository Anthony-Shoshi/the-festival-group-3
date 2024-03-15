<?php

namespace App\Services;

use App\Models\Session;
use App\Repositories\SessionRepository;
use Exception;

class SessionService
{
    private $sessionRepository;

    public function __construct()
    {
        $this->sessionRepository = new SessionRepository();
    }

    public function getAllSessions()
    {
        try {
            return $this->sessionRepository->getAllSessions();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function createSession($totalSessions, $duration, $firstSession)
    {
        try {
            $session = new Session();
            $session->setTotalSessions($totalSessions);
            $session->setDuration($duration);
            $session->setFirstSession($firstSession);
            return $this->sessionRepository->createSession($session);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getSession($sessionId)
    {
        try {
            return $this->sessionRepository->getSession($sessionId);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateSession($sessionId, $totalSessions, $duration, $firstSession)
    {
        try {
            $session = new Session();
            $session->setSessionId($sessionId);
            $session->setTotalSessions($totalSessions);
            $session->setDuration($duration);
            $session->setFirstSession($firstSession);
            return $this->sessionRepository->updateSession($session);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function deleteSession($sessionId)
    {
        try {
            return $this->sessionRepository->deleteSession($sessionId);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
