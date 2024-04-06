<?php include __DIR__ . '/../inc/header.php'; ?>

<link rel="stylesheet" href="/frontend/css/dance.css"/>
<title>Dance</title>
</head>
<body>
<div id="section-dance">
    <div class="dance-image">
        <img src="/images/dance-head.jpg" alt="DANCE!">
        <h1>DANCE!</h1>
    </div>
</div>

<div class="section-2">
    <h2 class="artist-list">Our Artists</h2>
    <div class="artists-container">
        <?php foreach ($artists as $artist): ?>
            <div class="artist-containers">
                <div class="artist">
                    <a href="/dance/artists?id=<?= $artist['artist_id']; ?>">
                        <div class="artist-image">
                            <img src="<?= '/images/' . $artist['image_url'] ?>" alt="<?= $artist['artist_name']; ?>">
                        </div>
                        <div class="artist-name"><?= $artist['artist_name']; ?></div>
                    </a>
                </div>
                <div class="background-rectangle"></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="section-3">
    <h2 class="venue-list">Our Locations</h2>
    <div class="venues-container">
        <?php foreach ($venues as $venue) :?>
            <div class="venue">
                <div class="venue-image">
                    <img src="<?= '/images/' . $venue['venue_image'] ?>" alt="<?= $venue['venue_name']; ?>">
                </div>
                <div class="venue-name"><?= $venue['venue_name']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="section-4">
    <h2 class="ticket-list">Tickets</h2>
    <?php foreach ($allAccessPass as $pass): ?>
        <div class="ticket-container">
            <div class="top-section">
                <p class="pass-name"><?= $pass['passName']; ?></p>
            </div>
            <div class="bottom-section">
                <p class="pass-description-price"><?= $pass['passDescription']; ?> - €<?= $pass['passPrice']; ?></p>
                <button class="buy-button">BUY</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php include __DIR__ . '/../inc/footer.php'; ?>
</body>
