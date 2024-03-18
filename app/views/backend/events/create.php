<?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mb-5">
        <h1>Add Event</h1>
        <div class="mt-4">
            <form action="/events/store" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Event Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                </div>
                <div class="mb-3">
                    <label for="event_types" class="form-label">Role</label>
                    <select class="form-select" id="event_types" name="event_types" required>
                        <?php foreach ($eventtypes as $eventtype) : ?>
                            <option value="<?= $eventtype ?>"><?= $eventtype ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <div class="mb-3">
                    <label for="primary_color" class="form-label">Primary color</label>
                    <input type="text" class="form-control" id="primary_color" name="primary_color" required>
                </div>
                <div class="mb-3">
                    <label for="secondary_color" class="form-label">Secondary Color</label>
                    <input type="text" class="form-control" id="secondary_color" name="secondary_color" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

<?php include __DIR__ . '/../inc/footer.php'; ?>