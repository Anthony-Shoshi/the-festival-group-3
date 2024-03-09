<?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mb-5">
        <h1>Edit Location Information</h1>
        <div class="mt-4">
            <form action="/history/update" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" value="<?= $location['location_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" value="<?= $location['description'] ?>" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= $location['address'] ?>" required>
                </div>
                <div class="mb-5">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    <?php if (empty($user['profile_picture'])) : ?>
                        <img src="/backend/img/default.jpg" class="mt-2" width="100" height="100" alt="Default Profile Picture">
                    <?php else : ?>
                        <img src="<?= $user['profile_picture'] ?>" class="mt-2" width="100" height="100" alt="Profile Picture">
                    <?php endif; ?>
                </div>
                <input type="hidden" name="user_id" value="<?= $location['tour_location_id'] ?>">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

<?php include __DIR__ . '/../inc/footer.php'; ?>