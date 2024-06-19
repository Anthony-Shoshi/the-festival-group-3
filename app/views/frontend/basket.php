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
                    <td>
                        <?php if (isset($item['reservation_date'])): ?>
                            <?php echo 'Reservation'; ?>
                        <?php elseif(isset($item['ticketType'])): ?>
                            <?php echo 'History Ticket'; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($item['reservation_date'])) : ?>
                            <?php echo htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['reservation_date']); ?>
                        <?php elseif(isset($item['ticketType'])): ?>
                            <?php echo htmlspecialchars($item['start_location']) . ' - ' . htmlspecialchars($item['timeslot']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
<!--                        --><?php //echo isset($item['total_adult']) ? ; ?>
                        <?php if (isset($item['total_adult'])) : ?>
                            <?php echo htmlspecialchars($item['total_adult'] + $item['total_children']).htmlspecialchars($item['quantity']); ?>
                        <?php elseif(isset($item['ticketType'])): ?>
                            <?php echo htmlspecialchars($item['participants']); ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['cost']); ?> EUR</td>
                    <td><a href="/personalprogram/removeItem?index=<?php echo $index; ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (empty($reservations)) : ?>
        <p>Your basket is empty.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/inc/footer.php'; ?>

