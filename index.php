<?php
$title = 'home';
$valid_titles = array('signup', 'galery', 'login', 'logout', 'post_webcam', 'post_upload', 'account', 'my_posts', 'view_post', 'confirmation', 'reset_email');
if (isset($_GET['p']) && in_array($_GET['p'], $valid_titles)) {
    $titles = array(
        'signup' => 'Signup',
        'galery' => 'Galery',
        'login' => 'Login',
        'logout' => 'Logout',
        'post_webcam' => 'Post',
        'post_upload' => 'Post',
        'account' => 'My account',
        'my_posts' => 'My posts',
        'view_post' => 'Post',
        'confirmation' => 'Account confirmation',
        'reset_email' => 'Reset my email'
    );
    $title = $titles[$_GET['p']];
    $css = './app/assets/css/'.$_GET['p'].'.css';
} else {
    $title = 'Galery';
    $css = './app/assets/css/galery.css';
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
        view_account_confirmation($_GET['email'], $_GET['hash']);
    else if ($_GET['p'] === 'reset_email')
        view_reset_email($_GET['email'], $_GET['hash']);
    else 
        view_galery();
} else {
    view_galery();
}

require_once 'app/views/layouts/footer.php';