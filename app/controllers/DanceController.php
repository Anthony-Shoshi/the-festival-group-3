<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Dance;
use App\Models\Artist;
use App\Models\Venue;
use App\Services\VenueService;
use App\Services\ArtistService;
use App\Services\DanceService;

use Exception;

class DanceController
{
    private DanceService $danceService;
    private ArtistService $artistService;
    private VenueService $venueService;

    public function __construct()
    {
        $this->danceService = new DanceService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
    }
    public function index()
    {
        $artists = $this->artistService->getAllArtists();
        $venues = $this->venueService->getAllVenues();
        require __DIR__ . '/../views/frontend/dance/index.php';
    }
}