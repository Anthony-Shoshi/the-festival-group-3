<?php include __DIR__ . '/../inc/header.php' ?>

<link rel="stylesheet" href="/frontend/css/yummy.css" />

<div class="white-space"></div>
<?php foreach ($sections as $section) : ?>
    <?php if ($section->getSectionType() === 'header') : ?>
        <div class="intro">
            <div class="text">
                <h1><?= $section->getSectionTitle() ?></h1>
                <p class=""><?= $section->getSubSectionTitle() ?></p>
                <?= $section->getContent() ?>
                <br>
                <a class="intro-button" href="">Check out Restaurants</a>
            </div>
            <div class="img-wrap">
                <img src="<?= $section->getImageUrl() ?>" />
            </div>
        </div>
    <?php endif; ?>
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
                                <span><?= $feature['name'] ?></span>
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
<?php endforeach; ?>

<?php include __DIR__ . '/../inc/footer.php'; ?>