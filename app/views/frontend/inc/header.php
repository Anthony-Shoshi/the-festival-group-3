<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "The Festival"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="msapplication-TileColor" content="#da532c">
    <link rel="icon" type="image/x-icon" href="/backend/img/fav.png">

    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/images/logo.png" alt="logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/homepage">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/breakfastpage">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/lunchpage">Yummy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dinnerpage">Dance</a>
                    </li>
                    <?php if (!isset($_SESSION['username']) && empty($_SESSION['username'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login/login">Login</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['username'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login/logout">Logout</a>
                        </li>
                    <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>