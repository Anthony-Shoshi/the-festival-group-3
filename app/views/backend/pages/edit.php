<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mb-5">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h1>Edit Page</h1>
    <div class="mt-4">
        <form action="/page/update" method="POST" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="page_id" value="<?= $page['page_id'] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" value="<?= $page['title'] ?>" name="title" required>
            </div>
            <div class="mb-3">
                <label for="page_url" class="form-label">Page Url</label>
                <input type="text" class="form-control" id="page_url" value="<?= $page['page_url'] ?>" name="page_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>