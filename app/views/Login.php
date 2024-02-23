<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/headerstyling.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="bg-dark p-5 text-white">
<div class="container">
    <div class="login-container">

        <div class="d-flex flex-column">
            <h1>Welcome To Haarlem Festival</h1>
            <br>
            <form method='POST'>
                <div>
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                    </div>
                    <div>
                        <input class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                    </div>
                    <button class="btn btn-success" type="submit" name="login-button">Login</button>
                </div>
            </form>
            <br>
            <p><?php echo isset($loginError) ? htmlspecialchars($loginError) : ""; ?></p>
            <form class="register-form" action="/login/createNewUser" method="POST">
                <div>
                    <button class="register-btn btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" name="registerSubmit" type="submit">Don't have an account? Sign Up</button>
                </div>
            </form>
            <form class="register-form" action="/login/resetPasswordViaEmail" method="POST">
                <div>
                    <button class="register-btn btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" name="registerSubmit" type="submit">Forgot Password?</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>



