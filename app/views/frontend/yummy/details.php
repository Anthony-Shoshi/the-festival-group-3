<?php include __DIR__ . '/../inc/header.php' ?>

<div class="restaurant-details">
    <h2><?php echo htmlspecialchars($restaurant['title']); ?></h2>
    <img src="<?php echo htmlspecialchars($restaurant['image_url']); ?>" alt="Restaurant Image">
    <p><?php echo html_entity_decode($restaurant['description']); ?></p>
    <p>Location: <?php echo htmlspecialchars($restaurant['location']); ?></p>
    <p>Cuisines: <?php echo htmlspecialchars($restaurant['cuisines']); ?></p>
    <p>Number of Seats: <?php echo htmlspecialchars($restaurant['number_of_seats']); ?></p>
    <!-- Add other details as needed -->
</div>

<div class="reservation-form">
    <h2>Make a Reservation</h2>

    <?php include __DIR__ . '/../../backend/inc/message.php'; ?>

    <form action="/reservation/create" method="POST">
        <input type="hidden" name="restaurant_id" value="<?php echo htmlspecialchars($restaurant['restaurant_id']); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" value="2024-07-27" min="2024-07-27" max="2024-07-31" required>
        </div>
        <div class="form-group">
            <label for="total_adult">Total Adults:</label>
            <input type="number" id="total_adult" name="total_adult" required>
        </div>
        <div class="form-group">
            <label for="total_children">Total Children:</label>
            <input type="number" id="total_children" name="total_children" required>
        </div>
        <div class="form-group">
            <label for="session_id">Session:</label>
            <select id="session_id" name="session_id" required>
                <option value="">Select Session</option>
                <?php foreach ($sessions as $session) : ?>
                    <?php
                    $start_time = new DateTime($session['start_time']);
                    $end_time = clone $start_time;
                    $end_time->add(new DateInterval('PT' . ($session['duration'] * 60) . 'M'));
                    $session_time = $start_time->format('H:i') . ' - ' . $end_time->format('H:i');
                    ?>
                    <option value="<?php echo htmlspecialchars($session['session_id']); ?>">
                        <?php echo htmlspecialchars($session_time); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo (isset($_SESSION['user'])) ? $_SESSION['user']['email'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>
        </div>
        <p>To make a reservation, you must pay 10 euro which will later be deducted from the total amount.</p>
        <button type="submit">Make Reservation</button>
    </form>
    <br>
    <br>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>