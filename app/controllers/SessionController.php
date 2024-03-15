<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\SessionService;
use Exception;

class SessionController
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        try {
            $sessions = $this->sessionService->getAllSessions();
            require __DIR__ . '/../views/backend/sessions/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function create()
    {
        require __DIR__ . '/../views/backend/sessions/create.php';
    }

    public function store()
    {
        try {

            $validatedData = Helper::validate($_POST);

            $total_session = $_POST['total_session'];
            $duration = $_POST['duration'];
            $first_session = $_POST['first_session'];

            $this->sessionService->createSession($total_session, $duration, $first_session);
            
            Helper::setMessage(false, "Session added successfully!");
            header("Location: /Session");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        if (isset($id) && $id > 0) {
            $session = $this->sessionService->getSession($id);
            require __DIR__ . '/../views/backend/sessions/edit.php';
        } else {
            header("Location: /error?message=something went wrong with this Session data!");
            exit();
        }
    }

    public function update()
    {
        try {
            $validatedData = Helper::validate($_POST);
            
            $sessionId = $_POST['id'];
            $total_session = $validatedData['total_session'];
            $duration = $validatedData['duration'];
            $first_session = $validatedData['first_session'];

            $this->sessionService->updateSession($sessionId, $total_session, $duration, $first_session);

            Helper::setMessage(false, "Session updated successfully!");
            header("Location: /session");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        if (isset($id) && $id > 0) {            
            Helper::setMessage(false, "Session deleted successfully!");
            header("Location: /session");
            exit();
        } else {
            header("Location: /error?message=something went wrong with this Session data!");
            exit();
        }
    }
}
