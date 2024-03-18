<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mb-5">
    <h1>Edit Venue</h1>
    <div class="mt-4">
        <form action="/events/update" method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $event['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="event_types" class="form-label">Role</label>
                <select class="form-select" id="event_types" name="event_types" required>
                    <?php foreach ($eventtypes as $eventtype) : ?>
                        <option value="<?= $eventtype ?>" <?php if ($eventtype == $event['event_type']) echo "selected"; ?>>
                            <?= $eventtype ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="about" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?= $event['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date"  value="<?= $event['start_date'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $event['end_date'] ?>"  required>
            </div>
            <div class="mb-3">
                <label for="primary_color" class="form-label">Primary color</label>
                <input type="text" class="form-control" id="primary_color" name="primary_color" value="<?= $event['primary_theme_color'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="secondary_color" class="form-label">Secondary Color</label>
                <input type="text" class="form-control" id="secondary_color" name="secondary_color" value="<?= $event['secondary_theme_color'] ?>" required>
            </div>
            <div class="mb-5">
                <label for="image-url" class="form-label">Event Image</label>
                <input type="file" class="form-control" id="image-url" name="image-url">
                <img src="<?= '/images/' . $event['image_url'] ?>" class="mt-2" width="100" height="100" alt="Event Image">
            </div>
            <input type="hidden" name="venue_id" value="<?= $event['event_id'] ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>
