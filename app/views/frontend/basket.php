<?php include __DIR__ . '/inc/header.php'; ?>

<?php
include __DIR__ . '/inc/message.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <td><a href="/reservation/removeItem?index=<?php echo $index; ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (!empty($_SESSION['cart'])) : ?>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
                <div class="cart-item" id="cart-item-<?php echo $index; ?>">
                    <div class="item-type"><?php echo ucfirst($item['type']); ?></div>
                    <div class="item-details">
                        <?php if ($item['type'] === 'pass') : ?>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
                        <?php elseif ($item['type'] === 'ticket') : ?>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
                            <p><strong>Venue:</strong> <?php echo htmlspecialchars($item['venue']); ?></p>
                            <p><strong>Date & Time:</strong> <?php echo htmlspecialchars($item['date'] . ' ' . $item['time']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="item-quantity"><?php echo htmlspecialchars($item['quantity']); ?></div>
                    <div class="item-total"><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?> EUR</div>
                    <div class="item-actions"><a href="#" onclick="removeItem(<?php echo $index; ?>); return false;">Remove</a></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($reservations) && empty($_SESSION['cart'])) : ?>
        <p>Your basket is empty.</p>
    <?php endif; ?>

    <?php if (!empty($reservations) || !empty($_SESSION['cart'])) : ?>
        <a href="/reservation/checkout" class="btn btn-primary">Checkout</a>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/inc/footer.php'; ?>

<script>
    function removeItem(index) {
        $.ajax({
            type: 'POST',
            url: '/personalprogram/removeItem',
            dataType: 'json', // Expect JSON response
            data: { index: index },
            success: function(response) {
                if (response.success) {
                    // Remove the item from the HTML
                    $('#cart-item-' + index).remove();
                    alert('Item removed from cart.');
                } else {
                    alert('Failed to remove item from cart: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ', status, error);
                alert('Failed to remove item from cart. Please try again later.');
            }
        });
    }
</script>
