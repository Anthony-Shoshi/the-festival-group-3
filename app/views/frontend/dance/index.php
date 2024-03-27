<?php include __DIR__ . '/../inc/header.php'; ?>

<link rel="stylesheet" href="/frontend/css/dance.css"/>
<title>Dance</title>
</head>
<body>
<div id="section-dance">
    <div class="dance-image">
        <a href="/dance/artists">
            <img src="/images/dance-head.jpg" alt="DANCE!">
        </a>
        <h1>DANCE!</h1>
    </div>
</div>
<div class="section-2">
    <h2 class="artist-list">Our Artists</h2>
    <div class="artists-container">
        <?php foreach ($artists as $artist) :?>
            <div class="artists">
                <a href="/dance/artists?id=<?= $artist['artist_id']; ?>">
                    <div class="artist-image">
                        <img src="<?= '/images/' . $artist['image_url'] ?>" alt="<?= $artist['artist_name']; ?>">
                    </div>
                    <div class="artist-name"><?= $artist['artist_name']; ?></div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<div class="section-3">
    <h2 class="artist-list">Our Locations</h2>
    <div class="venues-container">
        <?php foreach ($venues as $venue) :?>
            <div class="venues">
                <div class="venue-image">
                    <img src="<?= '/images/' . $venue['venue_image'] ?>" alt="<?= $venue['venue_name']; ?>">
                </div>
                <div class="venue-name"><?= $venue['venue_name']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . '/../inc/footer.php'; ?>

</body>
