<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1><?= $restaurant['title'] ?></h1>
                <a href="/restaurant" class="btn btn-success">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $restaurant['image_url'] ?>" class="img-fluid" alt="Restaurant Image">
                </div>
                <div class="col-md-6">
                    <h5>Description</h5>
                    <p><?= $restaurant['description'] ?></p>
                    <p><strong>Ratings:</strong> <?= $restaurant['ratings'] ?> star</p>
                    <p><strong>Cuisines:</strong> <?= $restaurant['cuisines'] ?></p>
                    <p><strong>Location:</strong> <?= $restaurant['location'] ?></p>
                    <p><strong>Number of Seats:</strong> <?= $restaurant['number_of_seats'] ?></p>
                    <p><strong>Contact Email:</strong> <?= $restaurant['contact_email'] ?></p>
                    <p><strong>Contact Phone:</strong> <?= $restaurant['contact_phone'] ?></p>
                    <h5>Session Information</h5>
                    <p><strong>Total Sessions:</strong> <?= $restaurant['total_session'] ?></p>
                    <p><strong>Duration per Session:</strong> <?= $restaurant['duration'] ?> hours</p>
                    <p><strong>First Session Time:</strong> <?= $restaurant['first_session'] ?></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5>Features</h5>
                    <?php if (!empty($restaurant['features'])) : ?>
                        <ul>
                            <?php foreach ($restaurant['features'] as $feature) : ?>
                                <li>
                                    <img src="<?= $feature['image_url'] ?>" alt="<?= $feature['name'] ?>" style="width: 20px; height: 20px;">
                                    <?= $feature['name'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>No features available</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5>Gallery Images</h5>
                    <?php $galleryImages = json_decode($restaurant['gallery_images'], true); ?>
                    <?php if (!empty($galleryImages)) : ?>
                        <div class="row">
                            <?php foreach ($galleryImages as $image) : ?>
                                <div class="col-md-3 mb-2">
                                    <img src="<?= $image ?>" alt="Gallery Image" class="img-fluid">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No gallery images available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>