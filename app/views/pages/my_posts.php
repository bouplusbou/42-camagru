<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">My posts</h1>
  </div>
</section>
<div class="container">
    <div class="columns">
        <div class="column"></div>
        <div class="column is-three-quarters">
            <div class="columns is-multiline is-centered ">
            <?php foreach ($user_posts as $user_post): ?>
                <div class="column is-4">
                    <div div_post="<?= $user_post->id_post; ?>" class="post_container">
                        <img src="<?= './app/assets/images/post_img/'.$user_post->photo_name; ?>" alt="">
                        <div class="overlay">
                            <div class="post_actions">
                            <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
                                <span class="icon">
                                    <i style="cursor: pointer" id_post="<?= $user_post->id_post; ?>" class="like_btn fas fa-heart fa-2x"></i>
                                    <p class="likes_nbr" id_post_show_likes="<?= $user_post->id_post; ?>"><?= $user_post->likes_count ? $user_post->likes_count : 0; ?></p>
                                </span>
                            <?php } ?>
                                <span class="icon">
                                    <a class="comment_btn" href="<?= 'index.php?p=view_post&id='.$user_post->id_post; ?>"><i class="fas fa-comment fa-2x"></i></a>
                                </span>
                            </div>
                            <i style="cursor: pointer" id_post="<?= $user_post->id_post; ?>" class="delete_btn fas fa-times"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
        <div class="column"></div>
    </div>
</div>












<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/myPosts.js"></script>

<div id="message" style="color:red;"></div>







<!-- <?php foreach ($user_posts as $user_post): ?>
<div div_post="<?= $user_post->id_post; ?>" class="post_container">
    <div class="post_header">
        <p><?= $user_post->username; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$user_post->photo_name; ?>" alt="">
    <div class="post_footer">
    <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
        <button class="like_btn" id_post="<?= $user_post->id_post; ?>">Like</button>
    <?php } ?>
        <a href="<?= 'index.php?p=view_post&id='.$user_post->id_post; ?>">View comments</a>
        <button class="delete_btn" id_post="<?= $user_post->id_post; ?>">Delete post</button>
        <div class="likes">
            <p id_post_show_likes="<?= $user_post->id_post; ?>"><?= $user_post->likes_count ? $user_post->likes_count : 0; ?></p>
            <p> Likes</p>
        </div>
    </div>
</div>
<?php endforeach; ?> -->