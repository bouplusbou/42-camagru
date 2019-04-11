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
        <?php if (isset($_SESSION['username'])) { ?>
            <a href="index.php?p=post">Post</a>
            <a href="index.php?p=logout">Logout</a>
        <?php } else { ?>
            <a href="index.php?p=login">Login</a>
            <a href="index.php?p=signup">Signup</a>
        <?php } ?>        
    </div>
