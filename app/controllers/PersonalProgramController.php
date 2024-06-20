<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Reservation;
use App\Services\Basket;
use App\Services\ReservationService;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
        $cartItems = $this->basket->getAllItems();
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
            $lineItems = [];

            foreach ($reservations as $reservationData) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Reservation for ' . $reservationData['restaurant_id'],
                        ],
                        'unit_amount' => $reservationData['cost_per_person'] * 100, // Amount in cents
                    ],
                    'quantity' => $reservationData['total_adult'] + $reservationData['total_children'],
                ];
            }

            Stripe::setApiKey("sk_test_51PS8HHF7UbSXoXFVQFRcOjx7b6nffHvGpqbNQngGmuaiOmyqxRA3IywweJclE1X0bTwFEkDBXUEwvkj0haSUPPfP00JhIdhACj");

            $session = Session::create([
                'payment_method_types' => ['ideal', 'card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => 'http://localhost/personalprogram/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://localhost/personalprogram/cancel',
            ]);

            header('Location: ' . $session->url);
            exit();
        } catch (Exception $e) {
            header('Location: /error?message=' . urlencode($e->getMessage()));
            exit();
        }
    }

    public function success()
    {
        try {
            $sessionId = $_GET['session_id'];
            Stripe::setApiKey('sk_test_51PS8HHF7UbSXoXFVQFRcOjx7b6nffHvGpqbNQngGmuaiOmyqxRA3IywweJclE1X0bTwFEkDBXUEwvkj0haSUPPfP00JhIdhACj');
            $session = Session::retrieve($sessionId);

            // Check payment status
            if ($session->payment_status === 'paid') {
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
                        $reservationData['cost_per_person']
                    );

                    $reservation->setPaymentStatus('completed');
                    $this->reservationService->createReservation($reservation);

                    $subject = 'Reservation Confirmation';
                    $body = 'Your reservation has been confirmed. Details: ' . json_encode($reservation->toArray());
                    $this->sendConfirmationEmail($reservationData['email'], $reservationData['name'], $subject, $body);
                }

                $this->basket->clearBasket();

                Helper::setMessage(false, "Reservations confirmed and stored successfully!");
                header("Location: /personalprogram/basket");
                exit();
            } else {
                throw new Exception('Payment was not successful.');
            }
        } catch (Exception $e) {
            header('Location: /error?message=' . urlencode($e->getMessage()));
            exit();
        }
    }

    public function cancel()
    {
        Helper::setMessage(true, "Payment was canceled.");
        header("Location: /personalprogram/basket");
        exit();
    }

    function sendConfirmationEmail($toEmail, $toName, $subject, $body)
    {
        $mailConfig = require_once __DIR__ . '/../config/mail.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = $mailConfig['host'];
            $mail->SMTPAuth   = $mailConfig['SMTPAuth'];
            $mail->Username   = $mailConfig['username'];
            $mail->Password   = $mailConfig['password'];
            $mail->SMTPSecure = $mailConfig['SMTPSecure'];
            $mail->Port       = $mailConfig['port'];

            //Recipients
            $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
            $mail->addAddress($toEmail, $toName);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
