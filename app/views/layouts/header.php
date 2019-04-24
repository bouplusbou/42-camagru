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
<body>
<!-- <div id="notification_wrapper" style="position:fixed;width:100%;z-index:100;"> -->
</div>
    <nav id="navbar" class="navbar" role="navigation">
        <div class="navbar-brand">
            <a href="index.php?p=galery" class="navbar-item">
                <img src="/app/assets/images/site/logo_black.png" alt="" >    
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-start">
            <?php if ($title !== 'Galery') { ?>
                <div class="navbar-item">
                    <a class="button" href="index.php?p=galery">Galery</a>
                </div>
            <?php } ?>
                <div class="navbar-item">
                    <a class="button is-primary" href="index.php?p=post_webcam">New post</a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <?php if (isset($_SESSION['username'])) { ?>
                        <a class="button" href="index.php?p=my_posts">My posts</a>
                        <a class="button" href="index.php?p=account">Account</a>
                        <a class="button" href="index.php?p=logout">Logout</a>
                    <?php } else { ?>
                        <a class="button" href="index.php?p=login">Login</a>
                        <a class="button" href="index.php?p=signup">Signup</a>
                    <?php } ?>  
                </div>
            </div>
        </div>
    </nav>





