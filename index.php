<?php
$title = 'home';

if (isset($_GET['p'])) {
    $title = $_GET['p'];
    $css = './app/assets/css/'.$title.'.css';
    $js = './app/assets/js/'.$title.'.js';
}
require_once 'app/views/layouts/header.php';
require_once 'app/controllers/PostsController.php';
require_once 'app/controllers/UsersController.php';

if (isset($_GET['p'])) {
    if ($_GET['p'] === 'signup')
        signup();
    if ($_GET['p'] === 'galery')
        listPosts();
    if ($_GET['p'] === 'login')
        login();
    if ($_GET['p'] === 'logout')
        logout();
    if ($_GET['p'] === 'post')
        newPost();
    if ($_GET['p'] === 'viewPost')
        viewPost($_GET['id']);
    if ($_GET['p'] === 'confirmation')
        confirmation($_GET['email'], $_GET['hash']);
} else {
    listPosts();
}

require_once 'app/views/layouts/footer.php';