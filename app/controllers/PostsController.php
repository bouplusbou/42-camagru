<?php

require_once __DIR__.'/../models/Post.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../models/Like.php';
require_once __DIR__.'/../models/User.php';

// if () {
//     session_start();

//     require_once '../../config/database.php';
//     $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//     $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//     $req = $PDO->query('SELECT * FROM posts');
//     $posts = $req->fetchAll();
//     foreach ($posts as $post) {
//         if ($post['id_user'] === $_SESSION['id_user']) {
//             $posts_photos[] = $post["photo_name"];
//         }
//     }
//     echo end($posts_photos);
// }



if (isset($_POST['action']) && $_POST['action'] === 'webcam_img_montage') {
    session_start();
    if( isset($_POST['img_data']) && isset($_POST['sticker_src']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){
        $img = $_POST['img_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $filedata = base64_decode($img);
    
        //saving
        $filename = '../assets/images/post_img/dst.png';
        file_put_contents($filename, $filedata);
    
        $img_src = "../assets/images/post_img/dst.png";
        $sticker_src = "../assets/images/stickers/" . basename($_POST['sticker_src']);
        
        $img = imagecreatefrompng($img_src);
        $sticker = imagecreatefrompng($sticker_src);
        imagecolortransparent($sticker, imagecolorat($sticker, 0, 0));
        
        $sticker_x = imagesx($sticker);
        $sticker_y = imagesy($sticker);
    
        $placement_x = intval($_POST['placement_x']);
        $placement_y = intval($_POST['placement_y']);
    
        imagecopy($img, $sticker, $placement_x, $placement_y, 0, 0, $sticker_x, $sticker_y);
    
        // Output and free from memory
        $timestamp = time();
        $filename = $timestamp.'.png';
        $filepath = '../assets/images/post_img/'.$filename;
        imagepng($img, $filepath);
    
        createPost($filename, $_SESSION['id_user']);
    
        imagedestroy($img);
        imagedestroy($sticker);
    
    } else {
        print_r($_POST);;
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'upload_img_montage') {
    session_start();
    if( isset($_POST['img_src']) && isset($_POST['sticker_src']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){
        $img_src = $_POST['img_src'];
        $sticker_src = "../assets/images/stickers/" . basename($_POST['sticker_src']);
        
        $img = imagecreatefrompng($img_src);
        $sticker = imagecreatefrompng($sticker_src);
        imagecolortransparent($sticker, imagecolorat($sticker, 0, 0));
        
        $sticker_x = imagesx($sticker);
        $sticker_y = imagesy($sticker);
    
        $placement_x = intval($_POST['placement_x']);
        $placement_y = intval($_POST['placement_y']);
    
        imagecopy($img, $sticker, $placement_x, $placement_y, 0, 0, $sticker_x, $sticker_y);
    
        // Output and free from memory
        $timestamp = time();
        $filename = $timestamp.'.png';
        $filepath = '../assets/images/post_img/'.$filename;
        imagepng($img, $filepath);
    
        createPost($filename, $_SESSION['id_user']);
    
        imagedestroy($img);
        imagedestroy($sticker);
    
    } else {
        print_r($_POST);;
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'create_like') {
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

if (isset($_POST['action']) && $_POST['action'] === 'delete_post') {
    session_start();
    if (isset($_POST['id_post']) && isset($_POST['id_user'])) {
        if ($_SESSION['id_user'] === $_POST['id_user']) {
            Post::deletePost($_POST['id_post'], $_POST['id_user']);
            echo "post deleted";
        } else {
            echo "user has no right to delete";
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'create_comment') {
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

        http://127.0.0.1:8080/index.php?p=view_post&id='.$_POST['id_post'].'
        
        ';
        // echo $creator['email'];
        // echo 'http://127.0.0.1:8080/index.php?p=view_post&id='.$_POST['id_post'];
        mail($creator['email'], $subject, $message);
    }
}

function view_post_webcam() {
    if (isset($_SESSION['username'])) {
        $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
        $posts = Post::getAllPosts();
        require_once __DIR__.'/../views/pages/post_webcam.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}

function createPost($photo_path, $id_user) {
    $creation_date = date("Y-m-d H:i:s");
    $post_data = array($photo_path, $creation_date, $id_user);
    $post = Post::insertPost($post_data);
}




function newPostWithImg($filename) {
    if (isset($_SESSION['username'])) {
        $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
        $posts = Post::getAllPosts();
        require_once __DIR__.'/../views/pages/post_upload.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}






/////////// Views ///////////


function view_galery() {
    $posts = Post::getAllPosts();
    require_once __DIR__.'/../views/pages/galery.php';
}


function view_one_post($id_post) {
    $post = Post::getOnePost($id_post);
    $comments = Comment::getComments($id_post);
    require_once __DIR__.'/../views/pages/view_post.php';
}


function view_post_upload() {
    $maxsize = 1048576;
    if ($_FILES['img']['size'] > $maxsize) {
        echo "Le fichier est trop gros";
        exit;
    }
    $valid_ext = array( 'png' );
    $file_ext = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );
    if (!in_array($file_ext, $valid_ext)) {
        echo "Extension incorrecte";
        exit;
    }
    $timestamp = time();
	$filename = $timestamp.'.png';
    $path = __DIR__."/../assets/images/user_img/".$filename;
    $res = move_uploaded_file($_FILES['img']['tmp_name'], $path);

    function resize_imagepng($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        return $dst;
    }
    $img = resize_imagepng($path, 640, 480);
    imagepng($img, $path);
    newPostWithImg($filename);
}

function view_my_posts() {
    if (isset($_SESSION['username'])) {
        $user_posts = Post::getUserPosts($_SESSION['username']);
        require_once __DIR__.'/../views/pages/my_posts.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}