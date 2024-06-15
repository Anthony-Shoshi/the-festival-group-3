<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\RestaurantService;
use App\Services\ArtistService;
use App\Services\VenueService;
use App\Services\DanceService;
use App\Services\SectionService;
use App\Services\EventService;
use App\Services\SessionService;
use Exception;

class HomeController
{
    protected $pageService;
    protected $sectionService;
    protected $restaurantService;
    protected $sessionService;
    protected $eventService;

    protected $artistService;
    protected $venueService;
    protected $danceService;

    public function __construct()
    {
        $this->sectionService = new SectionService();
        $this->restaurantService = new RestaurantService();
        $this->sessionService = new SessionService();
        $this->eventService = new EventService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
        $this->danceService = new DanceService();
    }

    public function index()
    {
        try {
            // Fetch all events
            $eventsData = $this->eventService->getAll();

            // Initialize arrays to store data for each enum
            $danceEvents = [];
            $historyEvents = [];
            $yummyEvents = [];

            // Iterate through the events data
            foreach ($eventsData as $event) {
                // Check the value of the 'event_type' enum
                switch ($event['event_type']) {
                    case 'Dance':
                        $danceEvents[] = $event;
                        break;
                    case 'History':
                        $historyEvents[] = $event;
                        break;
                    case 'Yummy':
                        $yummyEvents[] = $event;
                        break;
                    default:
                        break;
                }
            }
            require __DIR__ . '/../views/frontend/home.php';
        } catch (Exception $e) {
            // Handle exceptions
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }


    public function dashboard()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            require __DIR__ . '/../views/backend/home.php';
        } else {
            require __DIR__ . '/../views/frontend/home.php';
        }
    }

    public function overview()
    {
        require __DIR__ . '/../views/frontend/overview.php';
    }

    public function create()
    {
        require '../views/backend/users/create.php';
    }

    public function page()
    {
        $id = $_GET['id'];
        $slug = $_GET['slug'];
        $sections = $this->sectionService->getSectionByPageId($id);        
        switch ($slug) {
            case 'history':
                require '../views/frontend/history/index.php';
                break;
            case 'yummy':
                $restaurants = $this->restaurantService->getAllRestaurants();
                foreach ($restaurants as &$restaurant) {
                    $restaurant['sessions'] = $this->sessionService->getSessionsByRestaurantId($restaurant['restaurant_id']);
                }
                require '../views/frontend/yummy/index.php';
                break;
            case 'dance':
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
                break;
            default:
                require '../views/frontend/custom.php';
                break;
        }
    }
}
