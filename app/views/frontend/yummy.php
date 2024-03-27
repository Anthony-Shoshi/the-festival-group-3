<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/frontend/css/yummy.css" />
    <title>Yummy</title>
</head>

<body>
    <div class="white-space"></div>
    <div class="intro">
        <div class="text">
            <h1>YUMMY!</h1>
            <p class="">27 July - 31 July</p>
            <h2>
                Food Festival <br />
                Haarlem <br />
                Culinary 2024
            </h2>
            <p class="">
                Are you coming to the culinary event in Haarlem? It will take place from July 27 to July 31, 2024 on the Grote Markt in Haarlem. Make sure you're there! Enjoy
                various tastings and bands. Gather your company.
            </p>
            <a class="intro-button" href="">Check out Restaurants</a>
        </div>
        <div class="img-wrap">
            <img src="/images/yummy-intro.png" />
        </div>
    </div>
    <div class="restaurants-section">
        <div class="restaurant-top-line">
            <h2>Restaurants</h2>
            <div class="filter">
                <p>Filter by</p>
                <a id="active" href="">All restaurants</a>
                <a href="">French</a>
                <a href="">Dutch</a>
                <a href="">European</a>
                <a href="">International</a>
            </div>
        </div>
        <p class="description">Check out the awesome restaurants joining the fun below! Pick your favorites and get ready for a tasty adventure!</p>

        <div class="restaurants-list">
            <?php foreach ($restaurants as $restaurant) : ?>
                <div class="restaurants-list-item">
                    <div class="image" style="background-image: url('<?php echo $restaurant['image_url']; ?>');"></div>
                    <p><?php echo htmlspecialchars($restaurant['title']); ?></p>
                    <div class="review"></div>
                    <span class="line"></span>
                    <div class="restaurant-feature">
                        <img src="/images/food-type.png" alt="" />
                        <p>Food Type: <?php echo htmlspecialchars($restaurant['cuisines']); ?></p>
                    </div>
                    <div class="restaurant-feature">
                        <img src="/images/seats.png" alt="" />
                        <p>Available Seats: <?php echo $restaurant['number_of_seats']; ?></p>
                    </div>
                    <span class="line"></span>
                    <div class="features-list">
                        <?php foreach ($restaurant['features'] as $feature) : ?>
                            <div class="feature">
                                <img src="<?php echo $feature['image_url']; ?>" width="20" height="20" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <span class="line"></span>
                    <div class="restaurant-information">
                        <div class="info-item">
                            <img src="/images/location-marker.png" />
                            <p><?php echo htmlspecialchars($restaurant['location']); ?></p>
                        </div>
                        <div class="info-item">
                            <img src="/images/telephone.png" />
                            <p><?php echo htmlspecialchars($restaurant['contact_phone']); ?></p>
                        </div>
                        <div class="info-item">
                            <img src="/images/time.png" />
                            <p><?php echo $restaurant['first_session']; ?> - <?php echo $restaurant['duration']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
</body>

</html>