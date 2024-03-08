<?php
include __DIR__ . '/../inc/header.php';
?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Venue List</h1>
            <a href="/venue/create" class="btn btn-success">Add Venues</a>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($venues as $venue) : ?>
                    <tr>
                        <td><?= $venue['venue_id'] ?></td>
                        <td><img src="<?= '/images/' .  $venue['venue_image'] ?>" alt="<?= $venue['artist_name'] ?>" style="width: 100px;"></td>
                            <td><?= $venue['venue_name'] ?></td>
                        <td><?= $venue['venue_location'] ?></td>
                        <td><?= $venue['capacity'] ?></td>
                        <td>
                            <a href="/venue/edit?id=<?= $venue['venue_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $venue['venue_id'] ?>">Delete</button>
                            <div class="modal fade" id="deleteModal<?= $venue['venue_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $venue['venue_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $venue['venue_id'] ?>">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this venue?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="/venue/delete?id=<?= $venue['venue_id'] ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include __DIR__ . '/../inc/footer.php'; ?>