    <?php include __DIR__ . '/inc/header.php'; ?>
    <?php include __DIR__ . '/inc/message.php'; ?>

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
                            <?php
                            if (isset($item['reservation_date'])) {
                                echo 'Reservation';
                            } elseif (isset($item['ticketType'])) {
                                echo 'History Ticket';
                            } elseif (isset($item['music_performance_id'])) {
                                echo 'Dance Ticket';
                            }elseif (isset($item['passType'])) {
                                echo 'Dance Pass';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($item['reservation_date'])) {
                                echo htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['reservation_date']);
                            } elseif (isset($item['ticketType'])) {
                                echo htmlspecialchars($item['start_location']) . ' - ' . htmlspecialchars($item['timeslot']);
                            } elseif (isset($item['music_performance_id'])) {
                                echo htmlspecialchars($item['title']) . ' - ' . htmlspecialchars($item['start_date']);
                            }elseif (isset($item['passType'])) {
                                echo htmlspecialchars($item['passName']) . ' - ' . htmlspecialchars($item['passDescription']);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($item['total_adult'])) {
                                echo htmlspecialchars($item['total_adult'] + $item['total_children']) . htmlspecialchars($item['quantity']);
                            } elseif (isset($item['ticketType'])) {
                                echo htmlspecialchars($item['participants']);
                            } elseif (isset($item['music_performance_id'])) {
                                echo htmlspecialchars($item['quantity']);
                            }elseif (isset($item['passType'])) {
                                echo htmlspecialchars($item['quantity']);
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['cost']); ?> EUR</td>
                        <td><a href="/personalprogram/removeItem?index=<?php echo $index; ?>">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Your basket is empty.</p>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/inc/footer.php'; ?>
