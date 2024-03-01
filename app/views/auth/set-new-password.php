<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="stylesheet" href="/frontend/css/style.css">
</head>
<body>
<div class="container">
    <h1>Set New Password</h1>
    <form action="/resetpassword/setNewPassword" method="post">
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <input type="submit" value="Set Password">
    </form>
</div>

</body>
</html>
