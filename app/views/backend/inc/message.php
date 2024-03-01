<div>
    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
</div>