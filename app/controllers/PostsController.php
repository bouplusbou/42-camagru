<?php

require './app/models/Post.php';

function newPost() {
    require './app/views/pages/post.php';
}


function listPosts() {
    $posts = Post::getAllPosts();
    require './app/views/pages/galery.php';
}

