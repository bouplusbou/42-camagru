<?php

require './app/models/Post.php';

function listPosts() {
    $posts = Post::getAllPosts();
    require './app/views/pages/galery.php';
}

function signup() {
    // throw new Exception('Impossible d\'ajouter le commentaire !');
    require './app/views/pages/signup.php';
}