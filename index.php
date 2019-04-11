<?php

if (isset($_GET['p'])) {
    $title = $_GET['p'];
}

require 'app/views/layouts/header.php';
require 'app/controllers/Controller.php';

if (isset($_GET['p'])) {
    if ($_GET['p'] === 'signup')
        signup();
    if ($_GET['p'] === 'galery')
        listPosts();
}

require 'app/views/layouts/footer.php';