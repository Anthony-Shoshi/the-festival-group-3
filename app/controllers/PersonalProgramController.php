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
        $index = $_GET['index'];
        $this->basket->removeItem($index);
        header("Location: /personalprogram/basket");
        exit();
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
