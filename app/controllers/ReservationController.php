<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Reservation;
use App\Services\Basket;
use App\Services\ReservationService;
use Exception;

class ReservationController
{
    private $reservationService;
    private $basket;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
        $this->basket = new Basket();
    }

    public function create()
    {
        try {
            $validatedData = Helper::validate($_POST);

            $name = $validatedData['name'];
            $reservation_date = $validatedData['reservation_date'];
            $total_adult = $validatedData['total_adult'];
            $total_children = $validatedData['total_children'];
            $phone = $validatedData['phone'];
            $session_id = $validatedData['session_id'];
            $restaurant_id = $validatedData['restaurant_id'];
            $remarks = $_POST['remarks'];
            $cost_per_person = 10; // Assuming a fixed cost per person

            $reservation = new Reservation(
                $name,
                $reservation_date,
                $total_adult,
                $total_children,
                $phone,
                null, // user_id
                $session_id,
                $restaurant_id,
                $remarks,
                $cost_per_person
            );

            $this->basket->addItem($reservation);

            Helper::setMessage(false, "Reservation added to basket successfully!");
            header("Location: /personalprogram/basket");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateIsActiveToZero()
    {
        // Handle updating reservation is_active status to 0
    }

    public function index()
    {
        // Show list of all reservations
    }

    public function show($reservation_id)
    {
        // Show details of a specific reservation
    }

    public function getByRestaurant($restaurant_id)
    {
        // Show reservations for a specific restaurant
    }

    public function getByUser($user_id)
    {
        // Show reservations for a specific user
    }
}
