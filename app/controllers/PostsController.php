<?php

require_once __DIR__.'/../models/Post.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../models/Like.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/check_token.php';




/////////// Views ///////////

function view_galery() {
    $posts = Post::getLastFivePosts(isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0);
    $offset = 0;
    require_once __DIR__.'/../views/pages/galery.php';
}

function view_one_post($id_post) {
    if (isset($_SESSION['username'])) {
        $post = Post::getOnePost($id_post);
        $user_liked = Post::isLikedBy($id_post, $_SESSION['id_user']) == true;
        $comments = Comment::getComments($id_post);
        require_once __DIR__.'/../views/pages/view_post.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}

function view_my_posts() {
    if (isset($_SESSION['username'])) {
        $user_posts = Post::getUserPosts($_SESSION['username']);
        require_once __DIR__.'/../views/pages/my_posts.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}

function view_post_webcam() {
    if (isset($_SESSION['username'])) {
        $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
        $posts = Post::getUserPosts($_SESSION['username']);
        $posts = array_reverse(array_slice($posts, -6));
        require_once __DIR__.'/../views/pages/post_webcam.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}






/////////// CRUD ///////////

if (isset($_POST['action']) && $_POST['action'] === "get_next_five_posts" 
    && isset($_POST['offset']) 
    && isset($_POST['token'])) {
    session_start();
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    $posts = Post::getNextLastFivePosts($id_user, $_POST['offset']);
    $posts['connected'] = isset($_SESSION['username']) ? true : false;
    // var_dump($posts);
    echo json_encode($posts);
}

if (isset($_POST['action']) && $_POST['action'] === 'create_like') {
    session_start();
    if (check_token()) {
        if (isset($_POST['id_post'])) {
            if (Like::alreadyLiked($_POST['id_post'], $_SESSION['id_user'])) {
                Like::deleteLike($_POST['id_post'], $_SESSION['id_user']);
                echo "deleted";
            } else {
                Like::createLike($_POST['id_post'], $_SESSION['id_user']);
                echo "created";
            }
        }
    }  else {
        http_response_code(401);
        echo "⚠️ User is not authenticated";
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'delete_post') {
    session_start();
    if (check_token()) {
        if (isset($_POST['id_post']) && isset($_SESSION['id_user'])) {
            if (Post::getIdUserFromIdPost($_POST['id_post'])['id_user'] === $_SESSION['id_user']) {
                Post::deleteLikesFromPost($_POST['id_post']);
                Post::deleteCommentsFromPost($_POST['id_post']);
                Post::deletePost($_POST['id_post'], $_SESSION['id_user']);
                echo "Post deleted. Bye bye 👋";
            } else {
                http_response_code(400);
                echo "⚠️ You have no right to delete that";
            }
        }
    }  else {
        http_response_code(401);
        echo "⚠️ User is not authenticated";
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'create_comment') {
    session_start();
    if (check_token()) {
        $creation_date = date("Y-m-d H:i:s");
        $comment_data = array(htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8'), $creation_date, $_SESSION['id_user'], $_POST['id_post']);
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
    } else {
        http_response_code(401);
        echo "⚠️ User is not authenticated";
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'get_thumbnails') {
    session_start();
    $posts = Post::getAllPostsAsArray();
    foreach ($posts as $post) {
        if ($post['id_user'] === $_SESSION['id_user']) {
            $posts_photos[] = $post["photo_name"];
        }
    }
    echo end($posts_photos);
}



function create_post($photo_path, $id_user) {
    $creation_date = date("Y-m-d H:i:s");
    $post_data = array($photo_path, $creation_date, $id_user);
    $post = Post::insertPost($post_data);
}







if (isset($_POST['action']) && $_POST['action'] === 'webcam_img_montage') {
    session_start();
    if (check_token()) {
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
        
            create_post($filename, $_SESSION['id_user']);
        
            imagedestroy($img);
            imagedestroy($sticker);
        
        } else {
            // print_r($_POST);;
        }
    } else {
        http_response_code(401);
        echo "⚠️ User is not authenticated";
    }

}

function view_post_upload() {
    if (isset($_SESSION['username'])) {
        $stickers = array('beard', 'fries', 'grumpy', 'hands', 'pate', 'thug');
        $posts = Post::getUserPosts($_SESSION['username']);
        $posts = array_reverse(array_slice($posts, -6));
        if (isset($_FILES['img'])) {
            $filename = upload_img();
        }
        require_once __DIR__.'/../views/pages/post_upload.php';
    } else {
        require_once __DIR__.'/../views/pages/please_loggin.php';
    }
}

function upload_img() {
    $maxsize = 1048576;
    if ($_FILES['img']['size'] > $maxsize) {
        echo '<div class="notification is-danger"><div class="container"><p>⚠️ The file is too big (max. 1 Mo)</p></div></div>';
    } else {
        $valid_ext = array( 'png' );
        $file_ext = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );
        if (!in_array($file_ext, $valid_ext)) {
            echo '<div class="notification is-danger"><div class="container"><p>⚠️ Wrong type of file (PNG only)</p></div></div>';
        } else {
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
            $img = resize_imagepng($path, 800, 600);
            imagepng($img, $path);
            return $filename;
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'upload_img_montage') {
    session_start();
    if (check_token()) {
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
            
            create_post($filename, $_SESSION['id_user']);
        
            imagedestroy($img);
            imagedestroy($sticker);
        } else {
            echo '<div class="notification is-danger"><div class="container"><p>⚠️ Something went wrong !</p></div></div>';
        }
    } else {
        http_response_code(401);
        echo "⚠️ User is not authenticated";
    }
}
