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

if (isset($_POST['action']) && $_POST['action'] === 'create_comment') {
    require __DIR__.'/../models/Comment.php';
    require __DIR__.'/../models/User.php';
    $creation_date = date("Y-m-d H:i:s");
    $comment_data = array($_POST['comment'], $creation_date, $_POST['id_user'], $_POST['id_post']);
    // var_dump($comment_data);
    $comment = Comment::insertComment($comment_data);
    $creator = User::sendEmailWhenComment($_POST['id_post_creator']);
    if ($creator["email_when_comment"] === '1') {
        $subject = 'New comment on your post !';
        $message = '
        
        Hi'.$creator['username'].', 

        Someone just add a new comment on your post!
        You can check it out following this link right there :

        http://127.0.0.1:8080/index.php?p=viewPost&id='.$_POST['id_post'].'
        
        ';
        // echo $creator['email'];
        // echo 'http://127.0.0.1:8080/index.php?p=viewPost&id='.$_POST['id_post'];
        mail($creator['email'], $subject, $message);
    }
}

function newPost() {
    if (isset($_SESSION['username'])) {
        $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
        require './app/models/Post.php';
        $posts = Post::getAllPosts();
        require './app/views/pages/post.php';
    } else {
        require './app/views/pages/pleaseLoggin.php';
    }
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
