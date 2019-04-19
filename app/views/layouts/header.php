<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$css?>" type="text/css">

    <title><?= $title ?></title>
</head>
<body>
    <div id="header">
        <p>Camagru</p>
        <?php if ($title !== 'galery') { ?>
            <a href="index.php?p=galery">Galery</a>
        <?php } ?>
        <a href="index.php?p=post_webcam">Post</a>
        <?php if (isset($_SESSION['username'])) { ?>
            <a href="index.php?p=my_posts">My posts</a>
            <a href="index.php?p=account">Account</a>
            <a href="index.php?p=logout">Logout</a>
        <?php } else { ?>
            <a href="index.php?p=login">Login</a>
            <a href="index.php?p=signup">Signup</a>
        <?php } ?>        
    </div>
