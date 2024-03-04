<?php
include __DIR__ . '/inc/header.php';
$password = "Random_1234";
$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/';
var_dump(preg_match($pattern, $password));
die();
?>

<p> This is the home page</p>


