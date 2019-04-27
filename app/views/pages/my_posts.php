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


<!-- <?php foreach ($posts as $post): 
	if ($post->id_user === $_SESSION['id_user']) {?>
  <div div_post="<?= $post->id_post?>" class="thumbnail_container">
    <img class="thumbnail" src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
    <div class="thumbnail_overlay">
      <a id_post="<?= $post->id_post?>" class="delete"></a>
    </div>
  </div>
<?php } endforeach; ?> -->


<!-- <div class="columns">
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
</div> -->

<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/myPosts.js"></script>

