<?php include __DIR__ . '/../inc/header.php'; ?>

<title><?= $artists['artist_name']; ?></title>
<link rel="stylesheet" href="/frontend/css/artist.css">
</head>
<body>
<?php
?>

<div class="section-1">
    <div class="artist">
        <div class="artist-image">
            <img src="<?= '/images/' . $artists['image_url'] ?>" alt="<?= $artists['artist_name']; ?>">
        </div>
        <p><?= $artists['artist_name']; ?></p>
        <p><strong>Name:</strong> <?= $artists['artist_real_name']; ?></p>
        <p><strong>Age:</strong> <?= $artists['age']; ?></p>
        <p><strong>Nationality:</strong> <?= $artists['nationality']; ?></p>
        <p><strong>Genre:</strong> <?= $artists['genre']; ?></p>

    </div>
</div>


<div class="section-2">
    <div class="artist-aboutMe">
        <h2 class="artist-abm">About Me</h2>
        <p><?= $artists['about']; ?></p>
    </div>
</div>


<div class="section-3">
    <div class="artist-Conterts">
        <h2 class="artist-cons">Concerts</h2>
        <?php foreach ($artistEvents as $events): ?>
        <div class="container">
            <p class="event-date"><?= $events['event_date']; ?> - <?= $events['event_start_time']; ?> @ <?= $events['venue_name']; ?> - €<?= $events['event_price']; ?></p>
            <button class="favorite-button"><img src="/images/heart.png" alt="Favorite"></button>
            <button class="buyTicket-button">Buy Ticket</button>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="section-4">
    <div class="artist-albums">
        <h2 class="artist-cons">Best Albums</h2>
        <?php foreach ($artistAlbums as $album): ?>
            <div class="venue-image">
                <img src="<?= '/images/' . ($album['image_url']) ?>" alt="<?= ($album['album_name']); ?>">
            </div>
            <div class="album-name"><?= ($album['album_name']); ?></div>
            <div class="album-year">"<?= ($album['year']); ?>"</div>
    </div>
    <?php endforeach; ?>
    </div>
</div>


<div class="section-5">
    <div class="artist-songs">
        <h2 class="artist-cons"><?= htmlspecialchars($artists['artist_name']); ?>'s Music</h2>
        <?php foreach ($artistMusic as $music): ?>
            <div class="song-container">
                <div class="song-info">
                    <div class="song-name"><?= htmlspecialchars($music['music_title']); ?></div>
                    <div class="music-player">
                        <audio controls>
                            <source src="<?= '/music/' . htmlspecialchars($music['music_url']); ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div class="song-image">
                        <img src="<?= '/images/' . htmlspecialchars($music['image_url']) ?>" alt="<?= htmlspecialchars($music['music_title']); ?>">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="section-6">
    <div class="artist-albums">
        <h2 class="artist-cons">Awards</h2>
        <?php foreach ($artistAwards as $awards): ?>
        <div class="venue-image">
            <img src="<?= '/images/' . ($awards['image_url']) ?>" alt="<?= ($awards['title']); ?>">
        </div>
        <div class="album-name"><?= ($awards['title']); ?></div>
    </div>
    <?php endforeach; ?>
</div>
</div>


<a href="/dance" class="backButton">Back to Tickets Page</a>


<?php include __DIR__ . '/../inc/footer.php'; ?>
</body>
</html>
