<?php

require './app/controllers/Autoloader.php';

Autoloader::register();


if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// // init objets
$db = new DatabaseController();

ob_start();
if ($p === 'home') {
    require './app/views/pages/home.php';
} elseif ($p === 'login') {
    require './app/views/pages/login.php';
} elseif ($p === 'galery') {
    require './app/views/pages/galery.php';
} elseif ($p === 'signup') {
    require './app/views/pages/signup.php';
}
$content = ob_get_clean();
$title = $p;
require './app/views/layouts/default.php';