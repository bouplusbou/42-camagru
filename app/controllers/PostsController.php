<?php

if (isset($_POST['action']) && $_POST['action'] === 'create_like') {
    require __DIR__.'/../models/Like.php';
    if (isset($_POST['id_post']) && isset($_POST['id_user'])) {
        if (Like::alreadyLiked($_POST['id_post'], $_POST['id_user'])) {
            Like::deleteLike($_POST['id_post'], $_POST['id_user']);
            echo "deleted";
        } else {
            Like::createLike($_POST['id_post'], $_POST['id_user']);
            echo "created";
        }
    }
}

function newPost() {
    $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
    require './app/models/Post.php';
    $posts = Post::getAllPosts();
    require './app/views/pages/post.php';
}

function createPost($photo_path, $id_user) {
    require '../models/Post.php';
    $creation_date = date("Y-m-d H:i:s");
    $post_data = array($photo_path, $creation_date, $id_user);
    $post = Post::insertPost($post_data);
}

function listPosts() {
    require './app/models/Post.php';
    $posts = Post::getAllPosts();
    require './app/views/pages/galery.php';
}

function viewPost($id_post) {
    require './app/models/Post.php';
    require './app/models/Comment.php';
    $post = Post::getOnePost($id_post);
    $comments = Comment::getComments($id_post);
    require './app/views/pages/viewPost.php';
}
