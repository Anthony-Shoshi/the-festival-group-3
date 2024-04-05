<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Dance;
use App\Models\Artist;
use App\Models\Venue;
use App\Models\TicketPass;
use App\Services\VenueService;
use App\Services\ArtistService;
use App\Services\DanceService;
use App\Services\PageService;
use Exception;

class DanceController{
    private DanceService $danceService;
    private ArtistService $artistService;
    private VenueService $venueService;
    private pageService $pageService;

    public function __construct()
    {
        $this->danceService = new DanceService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
        $this->pageService = new PageService();
    }
    public function index()
    {
        $artists = $this->artistService->getAllArtists();
        $venues = $this->venueService->getAllVenues();
        $passes = $this->danceService->getAllPasses();
        require __DIR__ . '/../views/frontend/dance/index.php';
    }
    public function artists()
    {
        $artists = $this->artistService->getAllArtists();
        require __DIR__ . '/../views/frontend/dance/artists.php';
    }
}
// use models
