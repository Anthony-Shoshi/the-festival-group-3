<?php include __DIR__ . '/inc/header.php'; ?>


<?php

include __DIR__ . '/inc/message.php';

?>

<div class="basket" style="margin-top: 15%;">
    <h2>Your Basket</h2>
    <?php if (!empty($reservations)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Details</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $index => $item) : ?>
                    <tr>
                        <td><?php echo isset($item['reservation_date']) ? 'Reservation' : 'Event Ticket'; ?></td>
                        <td>
                            <?php if (isset($item['reservation_date'])) : ?>
                                <?php echo htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['reservation_date']); ?>
                            <?php else : ?>
                                <?php echo htmlspecialchars($item['event_name']) . ' - ' . htmlspecialchars($item['event_date']); ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo isset($item['total_adult']) ? htmlspecialchars($item['total_adult'] + $item['total_children']) : htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($item['cost']); ?> EUR</td>
                        <td><a href="/personalprogram/removeItem?index=<?php echo $index; ?>">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/personalprogram/checkout" class="btn btn-primary">Checkout</a>
    <?php else : ?>
        <p>Your basket is empty.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/inc/footer.php'; ?>