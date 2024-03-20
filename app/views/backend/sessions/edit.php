<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mb-5">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h1>Edit Session</h1>
    <div class="mt-4">
        <form action="/session/update" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="total_session" class="form-label">Number of Session</label>
                <input type="number" min="1" value="<?= $session['total_session'] ?>" class="form-control" id="total_session" name="total_session" required>
            </div>
            <div class="mb-3">
                <label for="first_session" class="form-label">First Session Time</label>
                <input type="time" value="<?= $session['first_session'] ?>" class="form-control" id="first_session" name="first_session" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration (each session in hour)</label>
                <input type="number" min="1" value="<?= $session['duration'] ?>" step="any" class="form-control" id="duration" name="duration" required>
            </div>
            <input type="hidden" name="id" value="<?= $session['session_id'] ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>