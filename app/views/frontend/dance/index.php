<?php include __DIR__ . '/../inc/header.php'; ?>

<link rel="stylesheet" href="/frontend/css/dance.css"/>
<title>Dance</title>
</head>
<body>
<div id="section-dance">
    <div class="dance-image">
        <img src="/images/dance-head.jpg" alt=""/>
        <h1>DANCE!</h1>
    </div>
</div>
<div class="section-2">
    <h2 class="artist-list">Our Artists</h2>
    <div class="artists-background">
        <div class="artists-container">
            <?php
            $count = 0;
            foreach ($artists as $artist) {
                $count++;
                ?>
                <div class="artist">
                    <div class="artist-image">
                        <img src="<?= '/images/' . $artist['image_url'] ?>">
                    </div>
                    <div class="artist-name"><?= $artist['artist_name']; ?></div>
                </div>
                <?php
                // Check if the count is a multiple of 3 to start a new line
                if ($count % 3 == 0) {
                    echo '<div class="artist"></div>';
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="section-3">
    <h2 class="venue-list">Our Locations</h2>
    <div class="venues-container">
        <?php foreach ($venues as $venue) :?>
            <div class="venues">
                <div class="venue-image">
                    <img src="<?= '/images/' . $venue['venue_image'] ?>">
                </div>
                <div class="venue-name"><?= $venue['venue_name']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
<?php include __DIR__ . '/../inc/footer.php'; ?>