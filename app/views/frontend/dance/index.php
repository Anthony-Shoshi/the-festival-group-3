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
<div class="section-4a">
    <h2 class="ticket-list">Tickets</h2>
    <h2 class="ticket-list">DANCE! - DAY 1</h2>
    <div class="passes-container">
        <?php foreach ($allAccessPass as $pass): ?>
            <div class="pass-container">
                <div class="top-section">
                    <p class="pass-name"><?= $pass['passName']; ?></p>
                </div>
                <div class="bottom-section">
                    <p class="pass-description-price"><?= $pass['passDescription']; ?> - €<?= $pass['passPrice']; ?></p>
                    <button class="buy-button">BUY</button>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($fridayPass as $pass): ?>
            <div class="pass-container">
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
    <div class="tickets-container">
        <?php foreach ($fridayTickets as $ticket): ?>
            <div class="ticket-container">
                <div class="ticket">
                    <div class="ticket-image">
                        <img src="<?= '/images/' . $ticket['music_event_image'] ?>" alt="<?= $ticket['event_name']; ?>">
                    </div>
                    <div class="ticket-details">
                        <h2><?= $ticket['event_name']; ?></h2>
                        <div class="ticket-info">
                            <p><strong>Location:</strong> <?= $ticket['venue_name']; ?></p>
                            <p><strong>Duration:</strong> <?= $ticket['event_duration']; ?></p>
                            <p><strong>Date & Time:</strong> <?= $ticket['event_date']; ?> <?= $ticket['event_start_time']; ?></p>
                            <p><strong>Session:</strong> <?= $ticket['session_type']; ?></p>
                            <p><strong>Price:</strong> <?= $ticket['event_price']; ?></p>
                        </div>
                    </div>
                    <div class="ticket-buttons">
                        <button class="favorite-button"><img src="/images/heart.png" alt="Favorite"></button>
                        <button class="buy-button">Buy</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div><div class="section-4b">
    <h2 class="ticket-list">DANCE! - DAY 2</h2>
    <div class="passes-container">
        <?php foreach ($allAccessPass as $pass): ?>
            <div class="pass-container">
                <div class="top-section">
                    <p class="pass-name"><?= $pass['passName']; ?></p>
                </div>
                <div class="bottom-section">
                    <p class="pass-description-price"><?= $pass['passDescription']; ?> - €<?= $pass['passPrice']; ?></p>
                    <button class="buy-button">BUY</button>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($saturdayPass as $pass): ?>
            <div class="pass-container">
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
    <div class="tickets-container">
        <?php foreach ($saturdayTickets as $ticket): ?>
            <div class="ticket-container">
                <div class="ticket">
                    <div class="ticket-image">
                        <img src="<?= '/images/' . $ticket['music_event_image'] ?>" alt="<?= $ticket['event_name']; ?>">
                    </div>
                    <div class="ticket-details">
                        <h2><?= $ticket['event_name']; ?></h2>
                        <div class="ticket-info">
                            <p><strong>Location:</strong> <?= $ticket['venue_name']; ?></p>
                            <p><strong>Duration:</strong> <?= $ticket['event_duration']; ?></p>
                            <p><strong>Date & Time:</strong> <?= $ticket['event_date']; ?> <?= $ticket['event_start_time']; ?></p>
                            <p><strong>Session:</strong> <?= $ticket['session_type']; ?></p>
                            <p><strong>Price:</strong> <?= $ticket['event_price']; ?></p>
                        </div>
                    </div>
                    <div class="ticket-buttons">
                        <button class="favorite-button"><img src="/images/heart.png" alt="Favorite"></button>
                        <button class="buy-button">Buy</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div><div class="section-4c">
    <h2 class="ticket-list">DANCE! - DAY 3</h2>
    <div class="passes-container">
        <?php foreach ($allAccessPass as $pass): ?>
            <div class="pass-container">
                <div class="top-section">
                    <p class="pass-name"><?= $pass['passName']; ?></p>
                </div>
                <div class="bottom-section">
                    <p class="pass-description-price"><?= $pass['passDescription']; ?> - €<?= $pass['passPrice']; ?></p>
                    <button class="buy-button">BUY</button>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($sundayPass as $pass): ?>
            <div class="pass-container">
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
    <div class="tickets-container">
        <?php foreach ($SundayTickets as $ticket): ?>
            <div class="ticket-container">
                <div class="ticket">
                    <div class="ticket-image">
                        <img src="<?= '/images/' . $ticket['music_event_image'] ?>" alt="<?= $ticket['event_name']; ?>">
                    </div>
                    <div class="ticket-details">
                        <h2><?= $ticket['event_name']; ?></h2>
                        <div class="ticket-info">
                            <p><strong>Location:</strong> <?= $ticket['venue_name']; ?></p>
                            <p><strong>Duration:</strong> <?= $ticket['event_duration']; ?></p>
                            <p><strong>Date & Time:</strong> <?= $ticket['event_date']; ?> <?= $ticket['event_start_time']; ?></p>
                            <p><strong>Session:</strong> <?= $ticket['session_type']; ?></p>
                            <p><strong>Price:</strong> <?= $ticket['event_price']; ?></p>
                        </div>
                    </div>
                    <div class="ticket-buttons">
                        <button class="favorite-button"><img src="/images/heart.png" alt="Favorite"></button>
                        <button class="buy-button">Buy</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . '/../inc/footer.php'; ?>
</body>
