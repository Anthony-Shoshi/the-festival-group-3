<?php
// Include necessary files and initialize any dependencies
use App\Services\ArtistService;

// Create an instance of the ArtistService
$artistService = new ArtistService();

// Retrieve the artist ID from the URL query parameters
$artistId = $_GET['artist_id'] ?? null;

// Fetch the artist details using the service method
$artistDetails = $artistService->getArtistByID($artistId);

// Return the artist details as JSON
header('Content-Type: application/json');
echo json_encode($artistDetails);
?>
