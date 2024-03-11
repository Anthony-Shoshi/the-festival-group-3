<?php
include __DIR__ . '/../inc/header.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Dance List</h1>
        <a href="/dancemanagement/create" class="btn btn-success">Add Dance</a>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Start Time</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Session Type</th>
                <th>Venue</th>
                <th>Artists</th>
            </tr>
            </thead>
            <tbody>


            <?php foreach ($dancesManages as $dance) : ?>
                <tr>
                    <td><?= $dance['event_id'] ?></td>
                    <td><img src="<?= '/images/' . $dance['image_url'] ?>" alt="<?= $dance['image_url'] ?>" style="width: 100px;"></td>
                    <td><?= $dance['title'] ?></td>
                    <td><?= $dance['description'] ?></td>
                    <td><?= $dance['start_date'] ?></td>
                    <td><?= $dance['end_date'] ?></td>
                    <td><?= $dance['event_start_time'] ?></td>
                    <td>&euro;<?= $dance['event_price'] ?></td>
                    <td><?= $dance['event_duration'] ?> minutes</td>
                    <td><?= $dance['session_type'] ?></td>
                    <td><?= $dance['venue_name'] ?></td>
                    <td><?= $dance['artist_names'] ?></td>

                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>
