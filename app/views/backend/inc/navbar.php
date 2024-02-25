<nav class="navbar navbar-expand-lg dashboard-nav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <img src="<?= $_SESSION['profile_picture']; ?>" alt="Profile Image" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                </li>
                <li class="nav-item">
                    <span class="nav-link">Welcome, <?= $_SESSION['username']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login/logout">Logout <i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>