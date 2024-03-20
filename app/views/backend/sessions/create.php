<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mb-5">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h1>Create Session</h1>
    <div class="mt-4">
        <form action="/session/store" method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="total_session" class="form-label">Number of Session</label>
                <input type="number" min="1" class="form-control" id="total_session" name="total_session" required>
            </div>
            <div class="mb-3">
                <label for="first_session" class="form-label">First Session Time</label>
                <input type="time" class="form-control" id="first_session" name="first_session" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration (each session in hour)</label>
                <input type="number" min="1" step="any" class="form-control" id="duration" name="duration" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>