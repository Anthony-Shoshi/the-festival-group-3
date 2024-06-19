<?php
include __DIR__ . '/inc/header.php';

session_start();

$isLoggedIn = isset($_SESSION['username']);
?>

<?php
// Include message file
include __DIR__ . '/inc/message.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem - Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007BFF;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .step {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }

        .step.active {
            border-bottom: 2px solid #007BFF;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin: 10px 0 5px;
        }

        form input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
        }

        .buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Payment</h2>
    <p>Just a few more steps to an epic experience!</p>
    <div class="progress-bar">
        <div class="step active">Personal details</div>
        <div class="step">Payment method</div>
        <div class="step">Confirmation</div>
    </div>

    <!-- Conditional Display based on login status -->
    <?php if ($isLoggedIn): ?>
        <div id="logged-in">
            <p>You have been logged in as <span id="username"><?= $_SESSION['username']; ?></span>. Do you want to continue as <span id="username"><?= $_SESSION['username']; ?></span> or do you want to order as Guest?</p>
            <div class="buttons">
                <button type="button">Return</button>
                <button type="button">Continue</button>
                <button type="button" onclick="showGuestForm()">Order as Guest</button>
            </div>
        </div>
        <form id="guest-form" style="display: none;">
            <label for="name">Your name*</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>
            <label for="phone">Phone Number*</label>
            <input type="tel" id="phone" name="phone" required>
            <div class="buttons">
                <button type="button">Return</button>
                <button type="submit">Next Step</button>
            </div>
        </form>
    <?php else: ?>
        <div id="not-logged-in" >
            <form>
                <label for="name">Your name*</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
                <label for="phone">Phone Number*</label>
                <input type="tel" id="phone" name="phone" required>
                <div class="buttons">
                    <button type="button">Return</button>
                    <button type="submit">Next Step</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<script>
    function showGuestForm() {
        document.getElementById('guest-form').style.display = 'block';
        document.getElementById('logged-in').style.display = 'none';
    }
</script>
</body>
</html>
