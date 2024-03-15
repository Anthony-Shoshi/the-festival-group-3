<?php

namespace App\Models;

class Session
{
    private int $sessionId;
    private int $totalSessions;
    private string $duration;
    private string $firstSession;

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function getTotalSessions()
    {
        return $this->totalSessions;
    }

    public function setTotalSessions($totalSessions)
    {
        $this->totalSessions = $totalSessions;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getFirstSession()
    {
        return $this->firstSession;
    }

    public function setFirstSession($firstSession)
    {
        $this->firstSession = $firstSession;
    }
}
