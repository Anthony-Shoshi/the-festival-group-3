<?php

namespace App\Controllers\Api;

class AddToCartController extends ApiBaseController
{
    public function addToCart()
    {
        // Ensure the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if 'action' parameter is set to 'addToCart'
            if (isset($_POST['action']) && $_POST['action'] === 'addToCart') {
                $type = $_POST['type'];
                $name = $_POST['name'];
                $venue = $_POST['venue'];
                $price = $_POST['price'];
                $date = $_POST['date'];
                $time = $_POST['time'];

                $item = [
                    'type' => $type,
                    'name' => $name,
                    'venue' => $venue,
                    'price' => $price,
                    'date' => $date,
                    'time' => $time,
                    'quantity' => 1  // You may adjust quantity handling based on your needs
                ];

                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $_SESSION['cart'][] = $item;

                // Respond to the AJAX request with a JSON success message
                echo json_encode(['success' => true]);
                exit;
            } else {
                // If action is not 'addToCart', respond with error message
                echo json_encode(['success' => false, 'message' => 'Invalid action']);
                exit;
            }
        } else {
            // If request method is not POST, respond with error message
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }
    }
}
?>
