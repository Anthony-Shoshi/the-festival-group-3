<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Artist;
use App\Services\ArtistService;
use Exception;

class ArtistController
{
    private ArtistService $artistService;

    public function __construct()
    {
        $this->artistService = new ArtistService();
    }
    public function index()
    {
        try {
            $artists = $this->artistService->getAllArtists();
            require __DIR__ . '/../views/backend/artists/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    public function create()
    {
        require 'app/views/backend/artists/create.php';
    }

    public function store()
    {
        $artist = new Artist();
        $artist->name = $_POST['name'];
        $artist->description = $_POST['description'];
        $artist->save();
        header('Location: /admin/artists');
    }

    public function edit()
    {
        try {
            $artist_id = $_GET['id'];
            $artists = $this->artistService->getArtistsById($artist_id);
            require_once __DIR__ . '/../views/backend/artists/edit.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function update()
    {
        try {
            $artist_id = $_POST['artist_id'];
            $image_url = null;

            // Check if a new image is uploaded
            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $newFileName = uniqid('', true) . '_' . $_FILES['image_url']['name'];
                $uploadFile = __DIR__ . '/../public/images/' . $newFileName;

                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array($imageFileType, $allowedExtensions)) {
                    throw new Exception('Invalid file format. Please upload a valid image file.');
                }

                if (!move_uploaded_file($_FILES['image_url']['tmp_name'], $uploadFile)) {
                    throw new Exception('Failed to upload image.');
                }

                $image_url = $newFileName;
            }

            // Create a new Artist object
            $artist = new Artist( // Modify this line to use the correct namespace
                $_POST['name'],
                $_POST['age'],
                $_POST['nationality'],
                $_POST['genre'],
                $_POST['about'],
                $image_url
            );

            // Update the artist
            $this->artistService->updateArtist($artist, $artist_id); // Modify this line to use the correct method

            $_SESSION['isError'] = 0;
            $_SESSION['flash_message'] = "Artist updated successfully!";
            header("Location: /artist");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }


}