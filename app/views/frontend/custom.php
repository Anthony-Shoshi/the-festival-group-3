<?php include __DIR__ . '/inc/header.php'; ?>

<h2>I am custom Page</h2>

<?php foreach ($sections as $section) : ?>
    <?php echo $section['title']; ?>
<?php endforeach; ?>

<?php include __DIR__ . '/inc/footer.php'; ?>