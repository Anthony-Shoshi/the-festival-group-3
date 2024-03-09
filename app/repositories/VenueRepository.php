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
            $stmt = $this->connection->prepare("SELECT * FROM dance_venues");
            $stmt->execute();
            $venues = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $venues;
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
    public function update(Venue $venue, $venue_id): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE dance_venues SET venue_name = :venue_name, venue_location = :venue_location, capacity = :capacity, venue_image = :venue_image WHERE venue_id = :venue_id");
            $stmt->execute([
                ':venue_id' => $venue_id,
                ':venue_name' => $venue->getVenue_name(),
                ':venue_location' => $venue->getVenue_location(),
                ':capacity' => $venue->getCapacity(),
                ':venue_image' => $venue->getVenue_image()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function storeVenue(Venue $Venue)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO dance_venues (venue_name, venue_location, capacity, venue_image) VALUES (:venue_name, :venue_location, :capacity, :venue_image)");
            $stmt->execute([
                ':venue_name' => $Venue->getname(),
                ':venue_location' => $Venue->getemail(),
                ':capacity' => $Venue->getpassword(),
                ':venue_image' => $Venue->getrole(),
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}