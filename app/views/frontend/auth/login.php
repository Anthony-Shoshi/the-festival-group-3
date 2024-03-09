<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/headerstyling.css">
    <link rel="icon" type="image/x-icon" href="/backend/img/fav.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body class="bg-dark p-5 text-white">
    <div class="container">
        <div class="login-container">

            <div>
                <?php if (isset($_SESSION['flash_message'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['flash_message'] ?>
                    </div>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>Welcome To Haarlem Festival</h1>
                <br>
                <form method='POST'>
                    <div>
                        <div>
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                        </div>
                        <div>
                            <input class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Enter your email address">
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required placeholder="Enter your password">
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit" name="login-button">Login</button>
                    </div>
                </form>
                <br>
                <p><?php echo isset($loginError) ? htmlspecialchars($loginError) : ""; ?></p>

                <a href="/login/signup" class="register-btn btn btn-lg btn-warning btn-login text-uppercase fw-bold mb-2">Don't have an account? Sign Up
                </a>
                
                <a href="/ForgotPassword/resetPassword" class="register-btn btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2">Forgot Password?
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>