<?php include __DIR__ . '/../inc/header.php'; ?>
<!--<link rel="stylesheet" href="/frontend/css/history.css"/>-->
<link rel="stylesheet" href="/frontend/css/header.css"/>
<title>History</title>
</head>
<style>
    #section-history-timeslots {
        background-color: #780b1e; /* Dark red background */
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .timeslot-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap; /* To ensure it wraps if there are more columns */
    }

    .day-column {
        background-color: #FFFFFF; /* White background for each day */
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        flex: 1;
        min-width: 200px; /* Adjust as needed */
        max-width: 300px; /* Adjust as needed */
    }

    .date-header {
        background-color: #fcebbd; /* Gold color for the date header */
        border-radius: 5px;
        padding: 5px;
    }

    .date {
        font-size: 1.2em;
        font-weight: bold;
    }

    .day-name {
        font-size: 1em;
    }

    .timeslot {
        background-color: #F5F5F5; /* Light gray background for each timeslot */
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
    }

    .time {
        font-size: 1em;
        font-weight: bold;
    }

    .languages {
        display: flex;
        justify-content: center;
        margin-top: 5px;
    }

    .language {
        margin: 0 5px;
    }

    .language img {
        width: 20px;
        height: 20px;
    }

    .guides {
        margin-top: 5px;
    }

    #book-button {
        display: block;
        background-color: #fcebbd; /* Gold background for the button */
        color: #000; /* Black text */
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 1.2em;
        font-weight: bold;
    }
    .header-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-size: cover;
        background-position: center;
        height: 400px; /* Adjust height as needed */
    }

    .header-text {
        color: white; /* Assuming text is white in image */
        text-align: center;
    }
    .introduction {
        padding: 20px;
        background-color: #f5f5f5; /* Adjust color as needed */
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333; /* Adjust color as needed */
    }

</style>
</head>
<body>
<div id="section-history-header">
    <div class="header-image">
        <?php foreach ($headers as $header): ?>
            <img src="<?= '/images/' . $header['image'] ?>" alt="header image">
            <div class="header-text">
                <h1><?= $header['description'] ?></h1>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-introduction">
    <div class="introduction">
        <?php foreach ($introduction as $intro): ?>
            <p><?= $intro['description'] ?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-information">
    <div class="information">
        <?php foreach ($information as $info): ?>
            <h2><?= $info['title'] ?></h2>
            <p><?= $info['description'] ?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-locations">
    <?php include __DIR__ . '/locationCarousel.php' ?>
</div>
<div id="section-history-routes">
    <div class="routes">
        <?php foreach ($routes as $route): ?>
            <h2><?= $route['title'] ?></h2>
            <p><?= $route['description'] ?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-tickets">
    <div class="tickets">
        <div class="regular-ticket">
            <?php foreach ($regularTickets as $regularTicket): ?>
                <h2><?= $regularTicket['title'] ?></h2>
                <p><?= $regularTicket['description'] ?></p>
            <?php endforeach; ?>
        </div>
        <div class="family-ticket">
            <?php foreach ($familyTickets as $familyTicket): ?>
                <h2><?= $familyTicket['title'] ?></h2>
                <p><?= $familyTicket['description'] ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div id="section-history-timeslots">
    <div class="timeslot-container">
        <?php foreach ($tours as $day): ?>
            <div class="day-column">
                <div class="date-header">
                    <p class="date"><?= htmlspecialchars($day['date']) ?></p>
                    <p class="day-name"><?= htmlspecialchars($day['day']) ?></p>
                </div>
                <?php foreach ($day['timeslots'] as $timeslot): ?>
                    <div class="timeslot">
                        <p class="time"><?= htmlspecialchars($timeslot['start_time']) ?> - <?= htmlspecialchars($timeslot['end_time']) ?></p>
                        <div class="languages">
                            <div class="language">
                                <img src="<?='/images/' . htmlspecialchars($timeslot['flag_image']) ?>" alt="Language Flag">
                            </div>
                        </div>
                        <div class="guides">
                            <p><?= htmlspecialchars($timeslot['available_guides']) ?> Guides</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <a id="book-button" href="#">Book a Ticket</a>
</div>


</body>
<?php include __DIR__ . '/../inc/footer.php'; ?>
