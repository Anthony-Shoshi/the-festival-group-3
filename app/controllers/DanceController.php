<?php

namespace App\Controllers;
use App\Services\Basket;
use App\Helpers\Helper;
use App\Models\Artist;
use App\Models\Dance;
use App\Models\TicketPass;
use App\Models\Venue;
use App\Services\ArtistService;
use App\Services\DanceService;
use App\Services\PageService;
use App\Services\VenueService;
use Exception;

class DanceController{
    private DanceService $danceService;
    private ArtistService $artistService;
    private VenueService $venueService;
    private pageService $pageService;
    private $basket;


    public function __construct()
    {
        $this->danceService = new DanceService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
        $this->basket = new Basket();
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
        $artistID = $_GET['id'];
        $artists = $this->artistService->getArtistsById($artistID);
        $artistEvents = $this->danceService->getEventsByArtistId($artistID);
        $artistAlbums = $this->artistService->getArtistsAlbum($artistID);
        $artistMusic = $this->artistService->getArtistMusic($artistID);
        $artistAwards = $this->artistService->getArtistAwards($artistID);


        require __DIR__ . '/../views/frontend/dance/artists.php';
    }
    public function addPassToBasket()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Method Not Allowed']);
            exit();
        }

        $passType = $_POST['pass_type'] ?? null;

        if ($passType === null) {
            // Debugging: Print POST data
            error_log('POST data: ' . print_r($_POST, true));
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Pass type is required']);
            exit();
        }

        try {
            // Fetch pass details by pass type
            $passDetails = $this->danceService->getPassDetailsByType($passType);

            if (!$passDetails) {
                throw new Exception('Pass not found');
            }

            // Create TicketPass object
            $pass = new TicketPass(
                $passDetails['pass_id'],
                $passDetails['passName'],
                $passDetails['passDescription'],
                $passDetails['passPrice'],
                $passDetails['passType'],
                $passDetails['total_cost'] // Assuming total_cost is same as pass_price
            );

            // Add TicketPass object to basket
            $this->basket->addItem($pass);

            // Return success response
            echo json_encode(['success' => true]);
            exit();
        } catch (Exception $e) {
            // Handle errors and return appropriate response
            http_response_code(400); // Bad Request
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }


    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Method Not Allowed']);
            exit();
        }

        // Example: Retrieve event ID from POST data
        $eventId = $_POST['music_performance_id'] ?? null;

        try {
            // Fetch event details based on $eventId
            $event = $this->danceService->getEventById($eventId); // Implement this method in DanceService

            // Example: Create Dance object (adjust fields as per your application)
            $dance = new Dance(
                $event['music_performance_id'],
                $event['music_event_id'],
                $event['event_price'],
                $event['session_type'],
                $event['event_date'],
                $event['event_start_time'],
                $event['event_duration'],
                $event['event_name'],
                $event['event_id'],
                $event['total_cost']
            );

            // Add Dance object to basket
            $this->basket->addItem($dance);

            // Return success response
            echo json_encode(['success' => true]);
            exit();
        } catch (Exception $e) {
            // Handle errors and return appropriate response
            http_response_code(400); // Bad Request
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }

}