<?php
namespace App\Services;
use App\Repositories\OrderRepository;

class OrderService{

    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function getTicketWithQRCode(string $qrCode)
    {
        return $this->orderRepository->getTicketWithQRCode($qrCode);
    }

    public function updateTicketStatus(int $ticketId, string $status): void
    {
        $this->orderRepository->updateTicketStatus($ticketId, $status);
    }
}