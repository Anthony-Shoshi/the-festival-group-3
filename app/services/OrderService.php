<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\OrderRepository;

class OrderService
{

    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function getTicketWithQRCode($qrCode)
    {
        return $this->orderRepository->getTicketWithQRCode($qrCode);
    }

    public function updateTicketStatus($qrCode)
    {
        return $this->orderRepository->updateTicketStatus($qrCode);
    }
    
    public function createOrder($userId, $totalAmount)
    {
        return $this->orderRepository->createOrder($userId, $totalAmount);
    }
    
    public function addOrderItem($orderId, $itemType, $itemId): void
    {
        $this->orderRepository->addOrderItem($orderId, $itemType, $itemId);
    }
    
    public function createTicket(Ticket $ticket)
    {
        return $this->orderRepository->createTicket($ticket);
    }
    
    public function getTicketsByOrderId(int $orderId)
    {
        return $this->orderRepository->getTicketsByOrderId($orderId);
    }
}
