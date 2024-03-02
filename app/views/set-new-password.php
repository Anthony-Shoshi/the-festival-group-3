<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <style>
        <?php include __DIR__ . '/../public/frontend/css/style.css'; ?>
    </style>
</head>
<body class="password-body">
<img src="/backend/img/logo.png" alt="Logo" class="logo">

<div class="container-password">
    <h1>Set New Password</h1>
    <form id="resetPasswordForm" method="post">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br>

        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            event.preventDefault();
        }
    });
</script>
