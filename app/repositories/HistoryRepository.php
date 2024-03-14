<?php
namespace App\Repositories;
use PDO;
use PDOException;

class HistoryRepository extends Repository
{
    private $db;

    public function getAllTourLocations()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM tour_locations");
            $stmt->execute();
            $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $history;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}