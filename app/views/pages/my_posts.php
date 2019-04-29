<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">My posts</h1>
  </div>
</section>

<div class="columns">
    <div class="column"></div>
    <div class="column is-one-third">
        <div class="columns is-multiline is-centered ">
        <?php foreach ($user_posts as $user_post): ?>
            <div class="column is-6">
                <div div_post="<?= $user_post->id_post?>" class="thumbnail_container">
                  <img class="thumbnail" src="<?= './app/assets/images/post_img/'.$user_post->photo_name; ?>" alt="">
                  <div class="thumbnail_overlay">
                    <a id_post="<?= $user_post->id_post?>" class="delete delete_btn"></a>
                  </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="column"></div>
</div>

<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/myPosts.js"></script>

