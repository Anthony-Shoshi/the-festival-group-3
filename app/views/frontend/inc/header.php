<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "The Festival"; ?>
    </title>
    <link rel="icon" type="image/x-icon" href="/images/fav.png">
    <link rel="stylesheet" href="/frontend/css/header.css" />
</head>

<body>
    <?php
        $pages = $this->pageService->getAllPages();
    ?>
    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/Logo.png" alt="Logo" />
        </a>

        <div class="navbar-nav" id="navbarLinks">

            <?php
            $pages = $this->pageService->getAllPages();

            foreach ($pages as $page) {
                $pageTitle = htmlspecialchars($page['title']);
                $pageSlug = $page['slug'];

                // Convert the page title to lowercase for comparison
                $lowerPageTitle = strtolower($pageTitle);

                // Check if the lowercase page title is "home" and set the URL accordingly
                $pageUrl = ($lowerPageTitle === 'home') ? '/' : '/home/page?slug=' . $pageSlug . '&id=' . $page['page_id'];

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