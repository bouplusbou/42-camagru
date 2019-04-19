<?php
$title = 'home';

if (isset($_GET['p'])) {
    $title = $_GET['p'];
    $css = './app/assets/css/'.$title.'.css';
    $js = './app/assets/js/'.$title.'.js';
}
require_once __DIR__.'/app/views/layouts/header.php';
require_once __DIR__.'/app/controllers/PostsController.php';
require_once __DIR__.'/app/controllers/UsersController.php';

if (isset($_GET['p'])) {
    if ($_GET['p'] === 'signup')
        view_signup();
    else if ($_GET['p'] === 'galery')
        view_galery();
    else if ($_GET['p'] === 'login')
        view_login();
    else if ($_GET['p'] === 'logout')
        view_logout();
    else if ($_GET['p'] === 'post_webcam')
        view_post_webcam();
    else if ($_GET['p'] === 'post_upload')
        view_post_upload();
    else if ($_GET['p'] === 'account')
        view_account();
    else if ($_GET['p'] === 'my_posts')
        view_my_posts();
    else if ($_GET['p'] === 'view_post')
        view_one_post($_GET['id']);
    else if ($_GET['p'] === 'confirmation')
        view_confirmation($_GET['email'], $_GET['hash']);
    else if ($_GET['p'] === 'resetEmail')
        view_reset_email($_GET['email'], $_GET['hash']);
    else 
        view_galery();
} else {
    view_galery();
}

require_once 'app/views/layouts/footer.php';