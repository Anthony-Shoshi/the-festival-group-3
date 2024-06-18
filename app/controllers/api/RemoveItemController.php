<?php

namespace App\Controllers\Api;

class RemoveItemController extends ApiBaseController
{
    public function removeItem()
    {
        // Ensure the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if 'index' parameter is set
            if (isset($_POST['index'])) {
                $index = $_POST['index'];

                // Check if session cart exists
                if (isset($_SESSION['cart'][$index])) {
                    // Remove item from session cart
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

                    // Respond to the AJAX request with a JSON success message
                    echo json_encode(['success' => true]);
                    exit;
                } else {
                    // If item not found in cart, respond with error message
                    echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
                    exit;
                }
            } else {
                // If 'index' parameter is not set, respond with error message
                echo json_encode(['success' => false, 'message' => 'Index parameter is missing']);
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
