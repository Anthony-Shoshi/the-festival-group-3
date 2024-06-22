<?php include __DIR__ . '/../inc/header.php' ?>

<link rel="stylesheet" href="/frontend/css/yummy.css" />

<style>
    .restaurants-list-item {
        width: 32%;
        margin: 1vw 0.5vw;
        padding: 1vw;
        background-color: #222;
        border-radius: 1em;
        color: #ff7a68;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease;
    }

    .restaurants-list-item:hover {
        transform: scale(1.05);
    }

    .restaurants-list-item .image {
        width: 100%;
        height: 200px;
        background-size: cover;
        background-position: center;
        border-radius: 1em;
        margin-bottom: 1vw;
    }

    .restaurants-list-item p {
        font-size: 2vw;
        font-weight: bold;
        margin: 0.5vw 0;
        color: #fff;
    }

    .review {
        color: #ff7a68;
        font-size: 1.5vw;
        margin: 0.5vw 0;
    }

    .line {
        height: 2px;
        background-color: #ff7a68;
        margin: 1vw 0;
    }

    .restaurant-feature {
        display: flex;
        align-items: center;
        margin: 0.5vw 0;
        color: #fff;
        font-size: 1.5vw;
    }

    .restaurant-feature img {
        margin-right: 0.5vw;
    }

    .features-list {
        display: flex;
        flex-wrap: wrap;
        margin: 1vw 0;
    }

    .feature {
        display: flex;
        align-items: center;
        margin: 0.5vw 1vw 0.5vw 0;
        color: #fff;
        font-size: 1.5vw;
    }

    .feature img {
        margin-right: 0.5vw;
    }

    .restaurant-information {
        display: flex;
        flex-wrap: wrap;
        margin: 1vw 0;
        gap: 1vw;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin: 0.5vw 0;
        color: #fff;
        font-size: 1.5vw;
    }

    .info-item img {
        margin-right: 0.5vw;
    }
</style>

<div class="white-space"></div>
<?php foreach ($sections as $section) : ?>
    <?php if ($section->getSectionType() === 'header') : ?>
        <div class="intro">
            <div class="text">
                <h1><?= $section->getSectionTitle() ?></h1>
                <p class=""><?= $section->getSubSectionTitle() ?></p>
                <?= $section->getContent() ?>
                <br>
                <a class="intro-button" href="#restaurants-section">Check out Restaurants</a>
            </div>
            <div class="img-wrap">
                <img src="<?= $section->getImageUrl() ?>" />
            </div>
        </div>
    <?php endif; ?>
    <div id="restaurants-section" class="restaurants-section">
        <div class="restaurant-top-line">
            <h2>Restaurants</h2>
            <!-- <div class="filter">
                <p>Filter by</p>
                <a id="active" href="">All restaurants</a>
                <a href="">French</a>
                <a href="">Dutch</a>
                <a href="">European</a>
                <a href="">International</a>
            </div> -->
        </div>
        <p class="description">Check out the awesome restaurants joining the fun below! Pick your favorites and get ready for a tasty adventure!</p>

        <div class="restaurants-list">
            <?php foreach ($restaurants as $restaurant) : ?>
                <p><?= $restaurant['restaurant_id'] ?></p>
                <div class="restaurants-list-item">
                    <a href="/restaurant/details?id=<?= $restaurant['restaurant_id'] ?>">
                        <div class="image" style="background-image: url('<?php echo $restaurant['image_url']; ?>');"></div>
                    </a>
                    <p><?php echo htmlspecialchars($restaurant['title']); ?></p>
                    <div class="review">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php if ($i < $restaurant['ratings']): ?>
                                ★
                            <?php else: ?>
                                ☆
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <span class="line"></span>
                    <div class="restaurant-feature">
                        <img src="/images/food-type.png" alt="" height="20" width="20"/>
                        <p>Food Type: <?php echo htmlspecialchars($restaurant['cuisines']); ?></p>
                    </div>
                    <div class="restaurant-feature">
                        <img src="/images/seats.png" alt="" height="20" width="20"/>
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
                            <?php if (!empty($restaurant['sessions'])): ?>
                            <img src="/images/time.png" />
                                <p>
                                    <?php echo $restaurant['start_time']; ?> - <?php echo $restaurant['end_time']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
<?php endforeach; ?>

<?php include __DIR__ . '/../inc/footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>