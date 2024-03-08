<?php

namespace App\Repositories;

use App\Models\Artist;
use Exception;
use PDO;
use PDOException;

class ArtistRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM artists");
            $stmt->execute();
            $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $artists;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getArtistsById(int $artist_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM artists WHERE artist_id = :artist_id");
            $stmt->bindParam(':artist_id', $artist_id);
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

    public function update(Artist $artist, $artist_id): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE artists SET artist_name = :artist_name, age = :age, nationality = :nationality, genre = :genre, about = :about, image_url = :image_url WHERE artist_id = :artist_id");
            $stmt->execute([
                ':artist_id' => $artist_id,
                ':artist_name' => $artist->getArtist_name(),
                ':age' => $artist->getAge(),
                ':nationality' => $artist->getNationality(),
                ':genre' => $artist->getGenre(),
                ':about' => $artist->getAbout(),
                ':image_url' => $artist->getImage_url()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
