<?php include __DIR__ . '/../inc/header.php'; ?>
<link rel="stylesheet" href="/frontend/css/header.css"/>
<link rel="stylesheet" href="/frontend/css/history.css"/>
<title>History</title>
</head>
<body>
<div id="section-history-header">
        <div class="header-image">
            <?php foreach ($headers as $header): ?>
            <img src="<?='/images/' . $header['image']?>" alt="header image">
            <div class="header-text">
                <h1><?= $header['description']?></h1>
            </div>
            <?php endforeach; ?>
        </div>
</div>
<div id="section-history-introduction">
    <div class="introduction">
        <?php foreach ($introduction as $intro): ?>
        <h2><?= $intro['title']?></h2>
        <p><?= $intro['description']?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-information">
    <div class="information">
        <?php foreach ($information as $info): ?>
        <h2><?= $info['title']?></h2>
        <p><?= $info['description']?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-routes">
    <div class="routes">
        <?php foreach ($routes as $route): ?>
        <h2><?= $route['title']?></h2>
        <p><?= $route['description']?></p>
        <?php endforeach; ?>
    </div>
</div>
<div id="section-history-tickets">
    <div class="tickets">
        <div class="regular-ticket">
            <?php foreach ($regularTicket as $ticket): ?>
            <h2><?= $ticket['title']?></h2>
            <p><?= $ticket['description']?></p>
            <?php endforeach; ?>
        </div>
        <div class="family-ticket">
            <?php foreach ($familyTicket as $ticket): ?>
            <h2><?= $ticket['title']?></h2>
            <p><?= $ticket['description']?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
<br>
<?php include __DIR__ . '/../inc/footer.php'; ?>
