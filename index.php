<?php

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

ob_start();
if ($p === 'home') {
    require 'app/controllers/PostsController.php';
    $controller = new PostsController();
    $controller->index();
} elseif ($p === 'login') {
    require './app/views/pages/login.php';
} elseif ($p === 'galery') {
    require 'app/controllers/PostsController.php';
    $controller = new PostsController();
    $controller->index();
} elseif ($p === 'signup') {
    require './app/views/pages/signup.php';
}
$content = ob_get_clean();
$title = $p;
require './app/views/layouts/default.php';