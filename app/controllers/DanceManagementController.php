<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Dance;
use App\Models\SessionType;
use App\Services\ArtistService;
use App\Services\DanceService;
use App\Services\VenueService;
use Exception;

class DanceManagementController
{
    private DanceService $danceService;
    private VenueService $venueService;
    private ArtistService $artistService;
    private SessionType $sessionType;

    public function __construct()
    {
        $this->danceService = new DanceService();
        $this->venueService = new VenueService();
        $this->artistService = new ArtistService();
        $this->sessionType = new SessionType();
    }



    public function index()
    {
        try {
            $dancesManages = $this->danceService->getAllEvents();
            require __DIR__ . '/../views/backend/danceManagement/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit()
    {
        $id = $_GET['id'];

        // Fetch the dance event details
        $dance = $this->danceService->getDanceEventById($id);

        // Fetch session types
        $sessionTypes = SessionType::getAll();

        // Fetch venues
        $venues = $this->venueService->getAllVenues();
        $venue_id = $dance['venue_id'];


        // Fetch artists
        $artists = $this->artistService->getAllArtists();
        $selectedArtistId = $dance['artist_id'];

        // Render the edit view with all necessary data
        require __DIR__ . '/../views/backend/danceManagement/edit.php';
    }


    public function update($id)
    {
        try {
            $dance = new Dance(
                $_POST['music_performance_id'],
                $_POST['music_event_id'],
                $_POST['event_price'],
                $_POST['session_type'],
                $_POST['start_date'],
                $_POST['event_start_time'],
                $_POST['event_duration'],
                $_POST['title'],
                $_POST['description'],
                $_POST['event_id'],
                $_POST['end_date'],
            );
            $this->danceService->updateEvent($dance, $id);
            header("Location: /dance-management");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

}