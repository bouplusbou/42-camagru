<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$css?>" type="text/css">
    <link rel="stylesheet" href="/app/assets/css/header.css" type="text/css">
    <link rel="stylesheet" href="/app/assets/css/footer.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title><?= $title ?></title>
</head>
<body class="site">
</div>
    <nav id="navbar" class="navbar" role="navigation">
        <div class="navbar-brand">
            <a href="index.php?p=galery" class="navbar-item">
                <img src="/app/assets/images/site/logo_black.png" alt="" >    
            </a>
            <div class="navbar-item">
            <?php if (isset($_SESSION['username'])) { ?>
                <?php if ($title !== 'Logout') { ?>
                <a class="button is-danger is-outlined" href="index.php?p=logout">Logout</a>
                <?php } ?>
            <?php } ?>  
            </div>
            <a id="burger" role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="menu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php if ($title !== 'New post') { ?>
                            <div class="navbar-item">
                                <a class="button is-primary" href="index.php?p=post_webcam">New post</a>
                            </div>
                        <?php } ?>
                        <?php if ($title !== 'Galery') { ?>
                            <a class="button" href="index.php?p=galery">Galery</a>
                        <?php } ?>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <?php if ($title !== 'My posts') { ?>
                            <a class="button" href="index.php?p=my_posts">My posts</a>
                            <?php } ?>
                            <?php if ($title !== 'Account') { ?>
                            <a class="button" href="index.php?p=account">Account</a>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($title !== 'Login') { ?>
                            <a class="button" href="index.php?p=login">Login</a>
                            <?php } ?>
                            <?php if ($title !== 'Signup') { ?>
                            <a class="button" href="index.php?p=signup">Signup</a>
                            <?php } ?>
                        <?php } ?>  
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script type="text/javascript" src="./app/assets/js/header.js"></script>
    <main class="site-content">




