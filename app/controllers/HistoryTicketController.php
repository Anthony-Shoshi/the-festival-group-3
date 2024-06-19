<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\HistoryTicket;
use App\Models\TicketType;
use App\Services\Basket;
use App\Services\HistoryService;
use DateTime;
use Exception;

class HistoryTicketController
{
    private $historyService;
    private $basketService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
        $this->basketService = new Basket();
    }
    public function create()
    {
        try {
            $ticketTypeStr = isset($_POST['ticketType']) ? htmlspecialchars(trim($_POST['ticketType']), ENT_QUOTES, 'UTF-8') : null;
            $price = isset($_POST['price']) ? floatval($_POST['price']) : null;
            $start_location = isset($_POST['start_location']) ? htmlspecialchars(trim($_POST['start_location']), ENT_QUOTES, 'UTF-8') : null;
            $timeslotStr = isset($_POST['timeslot']) ? htmlspecialchars(trim($_POST['timeslot']), ENT_QUOTES, 'UTF-8') : null;
            $participants = isset($_POST['participants']) ? intval($_POST['participants']) : null;
            var_dump($ticketTypeStr, $price, $start_location, $timeslotStr, $participants);
            if (empty($ticketTypeStr) || empty($price) || empty($start_location) || empty($timeslotStr)) {
                throw new Exception('Incomplete data received.');
            }
            $ticketType = TicketType::createFrom($ticketTypeStr);
            if (!$ticketType) {
                throw new Exception('Invalid ticket type.');
            }
            $timeslot = DateTime::createFromFormat('Y-m-d H:i:s', $timeslotStr);
            if (!$timeslot) {
                throw new Exception('Invalid timeslot format.');
            }
            $historyTicket = new HistoryTicket($ticketType, $price, $start_location, $timeslot, $participants);
            $this->basketService->addItem($historyTicket);
            echo json_encode(['success' => true]);
            exit();
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit();
        }
    }


}