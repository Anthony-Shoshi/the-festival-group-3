<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\SessionService;
use App\Services\RestaurantService;
use Exception;

class SessionController
{
    private $sessionService;
    private $restaurantService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->restaurantService = new RestaurantService();
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
        try {
            $restaurants = $this->restaurantService->getAllRestaurants();
            require __DIR__ . '/../views/backend/sessions/create.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function store()
    {
        try {
            $validatedData = Helper::validate($_POST);

            $restaurant_id = $validatedData['restaurant_id'];
            $start_time = $validatedData['start_time'];
            $duration = $validatedData['duration'];
            $sessions_per_day = $validatedData['sessions_per_day'];

            $this->sessionService->createSession($restaurant_id, $start_time, $duration, $sessions_per_day);

            Helper::setMessage(false, "Session added successfully!");
            header("Location: /session");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit()
    {
        try {
            $id = $_GET['id'];
            if (isset($id) && $id > 0) {
                $session = $this->sessionService->getSession($id);
                $restaurants = $this->restaurantService->getAllRestaurants();
                require __DIR__ . '/../views/backend/sessions/edit.php';
            } else {
                header("Location: /error?message=something went wrong with this session data!");
                exit();
            }
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function update()
    {
        try {
            $validatedData = Helper::validate($_POST);

            $sessionId = $_POST['id'];
            
            $restaurant_id = $validatedData['restaurant_id'];
            $start_time = $validatedData['start_time'];
            $duration = $validatedData['duration'];
            $sessions_per_day = $validatedData['sessions_per_day'];

            $this->sessionService->updateSession($sessionId, $restaurant_id, $start_time, $duration, $sessions_per_day);

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
        try {
            $id = $_GET['id'];
            if (isset($id) && $id > 0) {
                $this->sessionService->deleteSession($id);
                Helper::setMessage(false, "Session deleted successfully!");
                header("Location: /session");
                exit();
            } else {
                header("Location: /error?message=something went wrong with this session data!");
                exit();
            }
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}