<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Artist;
use App\Models\Dance;
use App\Models\TicketPass;
use App\Models\Venue;
use App\Services\ArtistService;
use App\Services\DanceService;
use App\Services\PageService;
use App\Services\VenueService;

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
        $fridayTickets = $this->danceService->getfridayEvents();
        $saturdayTickets = $this->danceService->getSaturdayEvents();
        $SundayTickets = $this->danceService->getSundayEvents();



        $fridayPass = [];
        $saturdayPass = [];
        $sundayPass = [];
        $allAccessPass = [];

        foreach ($passes as $pass) {
            switch ($pass['passType']) {
                case 'One-Day Pass (Friday)':
                    $fridayPass[] = $pass;
                    break;
                case 'One-Day Pass (Saturday)':
                    $saturdayPass[] = $pass;
                    break;
                case 'One-Day Pass (Sunday)':
                    $sundayPass[] = $pass;
                    break;
                case 'All-Access Pass':
                    $allAccessPass[] = $pass;
                    break;
                default:
                    break;
            }
        }
        require __DIR__ . '/../views/frontend/dance/index.php';
    }
    public function artists()
    {
        $artists = $this->artistService->getAllArtists();
        require __DIR__ . '/../views/frontend/dance/artists.php';
    }
}