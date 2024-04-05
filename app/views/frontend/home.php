<?php include __DIR__ . '/inc/header.php'; ?>
    <script>
        <?php include __DIR__ . '/../../public/backend/js/script.js'; ?>
    </script>
    <link rel="stylesheet" href="/frontend/css/home.css" />
    <title>Home</title>
</head>
<body>
    <div id="section-1">
        <div class="festival-image">
            <img src="/assets/images/image9.png" alt="" />
            <h1>HAARLEM FESTIVAL</h1>
        </div>
    </div>
    <div class="section">
        <h2>The largest Haarlem summer events of 2024 at a glance!</h2>
        <section class="img-p">
            <img src="/assets/images/section-2.png" />
            <div class="p-button">
                <p>
                    HAARLEM - The moment that many are eagerly awaiting: spring and summer are starting again and so event organizations can also go wild again. Which major
                    events can you expect in Haarlem in 2024? Here you will find an overview!
                </p>
                <a href="/home/overview">Upcoming Events</a>
            </div>
        </section>
    </div>
    <div class="section-heading">
        <h2>Event Location</h2>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2433.744888616002!2d4.6141989!3d52.3961483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6c60e1e9fb%3A0x8ae15680b8a17e39!2sHaarlem%2C%20Netherlands!5e0!3m2!1sen!2sin!4v1649839892387!5m2!1sen!2sin" width="1500" height="550" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="section-heading">
        <h2>Upcoming Events</h2>
    </div>
    <div class="event-section">
        <div class="event-section__body">
            <div class="event-section__image">
                <img src="/assets/images/map.png" alt="" />
            </div>
            <div class="event-section__text">
                <h2>A stroll through History</h2>
                <p>
                    Welcome to our "A Stroll Through History" tour! Over the next hour, we'll dive into the history of our city, checking out some of the oldest and coolest
                    buildings around. The tour is guided and available in English, Dutch, and Chinese, so everyone can join in on the fun!
                </p>
            </div>
            <a href="/history/index" class="event-section__button" id="event-section__button-history">26th till 29th July</a>
        </div>
    </div>
    <div class="event-section">
        <div class="event-section__body" id="event-section__body-dj">
            <div class="event-section__image">
                <img src="/assets/images/Dj-event.png" alt="Dj event" />
            </div>
            <div class="event-section__text" id="event-section__text-dj">
                <h2>Top DJ’s make an appearance</h2>
                <p>
                    Whether you enjoy house beats, techno vibes, or hip-hop rhythms, our diverse selection ensures there's something for everyone. So, lace up your dancing
                    shoes and prepare for an unforgettable clubbing experience!
                </p>
            </div>
            <a href="/dance" class="event-section__button" id="event-section__button-dj">27th till 29th July</a>
        </div>
    </div>
    <div class="event-section">
        <div class="event-section__body" id="event-section__body-yummy">
            <div class="event-section__image">
                <img src="/assets/images/yummy-event.png" alt="" />
            </div>
            <div class="event-section__text" id="event-section__text-yummy">
                <h2>Yummy! – a Food event</h2>
                <p>
                    Step into Yummie!, your gateway to a delightful culinary journey. Explore seven fantastic restaurants, each presenting a variety of international cuisines
                    to tantalize your taste buds. Indulge in diverse culinary options, including halal, vegan, and gluten-free choices.
                </p>
            </div>
            <a href="/yummy/index" class="event-section__button" id="event-section__button-yummy">26th till 30th July</a>
        </div>
    </div>
</body>
</html>

    <?php include __DIR__ . '/inc/footer.php'; ?>