<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Venue;
use App\Services\VenueService;
use Exception;

class VenueController{

    private VenueService $venueService;

    public function __construct()
    {
        $this->venueService = new VenueService();
    }
    public function index()
    {
        try {
            $venues = $this->venueService->getAllVenues();
            require __DIR__ . '/../views/backend/venues/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function create()
    {
        try {
            require_once __DIR__ . '/../views/backend/venues/create.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }    }

    public function store()
    {
        try {
            $imageUrl = null;

            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image_url'];
                $fileName = $file['name'];
                $newFileName = uniqid('', true) . '_' . $fileName;
                $uploadFile = __DIR__ . '/../public/images/' . $newFileName;

                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($imageFileType, $allowedExtensions)) {
                    throw new Exception('Invalid file format. Please upload a valid image file.');
                }

                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception('Failed to upload image.');
                }

                $imageUrl = $newFileName;
            }

            $venue = new Venue(null, $_POST['venue_name'], $_POST['venue_location'], $_POST['capacity'], $imageUrl);
            $this->venueService->createVenue($venue);
            header("Location: /venues");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function edit()
    {
        try {
            $artist_id = $_GET['id'];
            $venue = $this->venueService->getVenuesById($artist_id);
            require_once __DIR__ . '/../views/backend/venues/edit.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}