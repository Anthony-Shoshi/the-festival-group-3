<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" type="image/x-icon" href="/images/fav.png">
    <link rel="stylesheet" href="/frontend/css/header.css" />
    <!-- <!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "The Festival"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="msapplication-TileColor" content="#da532c">
    <link rel="icon" type="image/x-icon" href="/images/fav.png">

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
    </script> -->
    <!-- <nav class="navbar">
            <a class="logo">
                <img src="/app/public/assets/images/Logo.png" />
            </a>
            <ul class="nav-options">
                <li class="nav-option">Home</li>
                <li class="nav-option">Discover</li>
                <li class="nav-option">The Festival</li>
            </ul>
            <a class="language-selector">
                <img src="" alt="" />
            </a>
        </nav> -->

    <?php
    $pages = $this->pageService->getAllPages();
    ?>
    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/Logo.png" alt="Logo" />
        </a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        <div class="navbar-nav" id="navbarLinks">

            <?php
            $pages = $this->pageService->getAllPages();

            foreach ($pages as $page) {
                $pageTitle = htmlspecialchars($page['title']);
                $pageSlug = $page['slug'];

                // Convert the page title to lowercase for comparison
                $lowerPageTitle = strtolower($pageTitle);

                // Check if the lowercase page title is "home" and set the URL accordingly
                $pageUrl = ($lowerPageTitle === 'home') ? '/' : '/' . $pageSlug;

                echo '<div class="dropdown">
                          <a class="nav-link" href="' . $pageUrl . '">' . $pageTitle . '</a>
                      </div>';
            }

            ?>

            <?php
            if (isset($_SESSION['user'])) {
                if ($_SESSION['role'] == "Admin") {
                    echo '<a class="nav-link" href="/home/dashboard">' . $_SESSION['username'] . '</a>';
                } else {
                    echo '<a class="nav-link" href="javascript:void()">' . $_SESSION['username'] . '</a>';
                }
                echo '<a class="nav-link" href="/login/logout">Logout</a>';
            } else {
                echo '<a class="nav-link" href="/login/login">Login</a>';
            }
            ?>
        </div>

        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <script>
        const hamburger = document.querySelector(".hamburger");
        const navMenu = document.querySelector(".navbar-nav");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navMenu.classList.toggle("active");
        })
    </script>