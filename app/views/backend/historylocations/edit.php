<?php include __DIR__ . '/../inc/header.php'; ?>
<?php //var_dump($location['tour_location_id']); ?>
    <div class="container mb-5">
        <h1>Edit Location Information</h1>
        <div class="mt-4">
            <form action="/historylocation/update" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="location_name" class = "form-label">Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" value="<?= $tour['location_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?= $tour['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label><input type="text" class="form-control" id="address" name="address" value="<?= $tour['address'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Contact Info</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info" value="<?= $tour['contact_info'] ?>" required>
                <div class="mb-5">
                    <label for="profile_picture" class="form-label">Location Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                    <img src="<?= '/images/' . $tour['images'] ?>" class="mt-2" width="100" height="100" alt="Location Image">

                </div>
                <input type="hidden" name="tour_location_id" value="<?= $tour['tour_location_id'] ?>">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

<?php include __DIR__ . '/../inc/footer.php'; ?>