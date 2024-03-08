<?php

namespace App\Repositories;

use App\Models\Venue;
use Exception;
use PDO;
use PDOException;

class VenueRepository extends Repository{

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM dance_venues)");
            $stmt->execute();
            $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $artists;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getVenuesById($venueId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM dance_venues WHERE venue_id = :venue_id");
            $stmt->bindParam(':venue_id', $venueId);
            $stmt->execute();
            $venue = $stmt->fetch(PDO::FETCH_ASSOC);
            return $venue;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

}