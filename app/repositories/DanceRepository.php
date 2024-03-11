<?php
namespace App\Repositories;

use App\Models\Dance;
use Exception;
use PDO;
use PDOException;


class DanceRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT 
                mp.music_performance_id,
                mp.music_event_id,
                me.event_price,
                me.session_type,
                me.event_start_time,
                me.event_duration,
                GROUP_CONCAT(a.artist_name SEPARATOR ', ') AS artist_names,
                a.genre,
                a.about,
                e.event_id,
                e.title,
                e.description,
                e.start_date,
                e.end_date,
                e.image_url,
                dv.venue_name,
                dv.venue_location,
                dv.capacity
            FROM 
                music_performance AS mp
            JOIN 
                music_events AS me ON mp.music_event_id = me.music_event_id
            JOIN 
                artists AS a ON mp.artist_id = a.artist_id
            JOIN 
                events AS e ON me.event_id = e.event_id
            JOIN 
                dance_venues AS dv ON me.venue_id = dv.venue_id
            GROUP BY
                me.music_event_id
        ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }


    public function getDanceById(int $dance_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM dances WHERE dance_id = :dance_id");
            $stmt->bindParam(':dance_id', $dance_id);
            $stmt->execute();
            $pageRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $pageRow;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function update(Dance $dance, $dance_id): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE dances SET dance_name = :dance_name, description = :description, image_url = :image_url WHERE dance_id = :dance_id");
            $stmt->execute([
                ':dance_id' => $dance_id,
                ':dance_name' => $dance->getDance_name(),
                ':description' => $dance->getDescription(),
                ':image_url' => $dance->getImage_url()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function storeDance(Dance $dance)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO dances (dance_name, description, image_url) VALUES (:dance_name, :description, :image_url)");
            $stmt->execute([
                ':dance_name' => $dance->getDance_name(),
                ':description' => $dance->getDescription(),
                ':image_url' => $dance->getImage_url()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}