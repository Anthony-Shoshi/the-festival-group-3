<?php

namespace App\Repositories;

class OrderRepository extends Repository{
    public function getTicketWithQRCode(string $qrCode)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE qr_code = :qrCode");
        $stmt->bindParam(':qr_code', $qrCode);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTicketStatus(int $ticketId, string $status): void
    {
        $query = "UPDATE tickets SET status = :status WHERE id = :ticket_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':ticket_id', $ticketId);
        $stmt->execute();
    }
}
