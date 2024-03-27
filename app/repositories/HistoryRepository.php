<?php

namespace App\Repositories;

use App\Models\HistoryContent;
use App\Models\location;
use Exception;
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
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getTourLocationById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM tour_locations WHERE tour_location_id = :id");
            $stmt->execute([':id' => $id]);
            $location = $stmt->fetch(PDO::FETCH_ASSOC);
            return $location;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function addLocation(Location $location)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO tour_locations (location_name, description, address, contact_info, images) VALUES (:location_name, :description, :address, :contact_info, :images)");
            $stmt->execute([
                ':location_name' => $location->getLocation_name(),
                ':description' => $location->getDescription(),
                ':address' => $location->getAddress(),
                ':contact_info' => $location->getContact_info(),
                ':images' => $location->getImage_url()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateLocation(Location $location, $id): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE tour_locations SET location_name = :location_name, description = :description, address = :address, contact_info = :contact_info, images = :images WHERE tour_location_id = :id");
            $stmt->execute([
                ':location_name' => $location->getLocation_name(),
                ':description' => $location->getDescription(),
                ':address' => $location->getAddress(),
                ':contact_info' => $location->getContact_info(),
                ':images' => $location->getImage_url(),
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function deleteLocation($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM tour_locations WHERE tour_location_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getAllContent()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM history_info");
            $stmt->execute();
            $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $history;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }

    }

    public function getContentById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM history_info WHERE content_id = :id");
            $stmt->execute([':id' => $id]);
            $content = $stmt->fetch(PDO::FETCH_ASSOC);
            return $content;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function deleteContent($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM history_info WHERE content_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function addContent(HistoryContent $content)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO history_info (title, description, image, url) VALUES (:title, :description, :image, :url)");
            $stmt->execute([
                ':title' => $content->getTitle(),
                ':description' => $content->getDescription(),
                ':image' => $content->getImage(),
                ':url' => $content->getUrl()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function updateContent(HistoryContent $content, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE history_info SET title = :title, description = :description, image = :image, url = :url WHERE content_id = :id");
            $stmt->execute([
                ':title' => $content->getTitle(),
                ':description' => $content->getDescription(),
                ':image' => $content->getImage(),
                ':url' => $content->getUrl(),
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getAllTours()
    {
        try {
            $stmt = $this->connection->prepare("SELECT ht.date, ht.start_time, ht.end_time, tl.language_name, tl.flag_image, htour.available_guides, htour.tour_id
                                                FROM history_timeslots ht
                                                JOIN history_tours htour ON htour.timetable_id = ht.timetable_id
                                                JOIN tour_languages tl ON tl.language_id = htour.language_id");
            $stmt->execute();
            $tour = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tour;

        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}