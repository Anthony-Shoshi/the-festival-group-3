<?php
namespace App\Services;

use App\Models\Artist;
use App\Repositories\ArtistRepository;
use Exception;
class ArtistService
{
    private ArtistRepository $artistRepository;

    public function __construct()
    {
        $this->artistRepository = new ArtistRepository();
    }

    public function getAllArtists()
    {
        try {
            return $this->artistRepository->getAll();
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function getArtistsById(int $artist_id)
    {
        try {
            return $this->artistRepository->getArtistsById($artist_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
    public function updateArtist(Artist $artist, $artist_id): bool
    {
        try {
            return $this->artistRepository->update($artist, $artist_id);
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}