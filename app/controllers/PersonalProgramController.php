<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Reservation;
use App\Services\Basket;
use App\Services\ReservationService;
use Exception;

class PersonalProgramController
{
    private $reservationService;
    private $basket;

    public function __construct()
    {
        $this->basket = new Basket();
        $this->reservationService = new ReservationService();
    }

    public function basket()
    {
        $reservations = $this->basket->getAllItems();
        require __DIR__ . '/../views/frontend/basket.php';
    }

    public function removeItem()
    {
        // Check if the request method is POST and 'index' is set
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
            $index = $_POST['index'];

            // Implement your logic to remove item from session or database
            unset($_SESSION['cart'][$index]);

            // Respond with JSON success message
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
    }

    public function checkout()
    {
        try {
            $reservations = $this->basket->getAllItems();
            foreach ($reservations as $reservationData) {
                $reservation = new Reservation(
                    $reservationData['name'],
                    $reservationData['reservation_date'],
                    $reservationData['total_adult'],
                    $reservationData['total_children'],
                    $reservationData['email'],
                    $reservationData['phone'],
                    $reservationData['user_id'],
                    $reservationData['session_id'],
                    $reservationData['restaurant_id'],
                    $reservationData['remarks'],
                    $reservationData['cost_per_person'],
                    'completed'
                );

                $this->reservationService->createReservation($reservation);
            }

            $this->basket->clearBasket();

            Helper::setMessage(false, "Reservations confirmed and stored successfully!");
            header("Location: /personalprogram/basket");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function checkoutCart()
    {
        require __DIR__ . '/../views/frontend/checkout.php';
    }
}
