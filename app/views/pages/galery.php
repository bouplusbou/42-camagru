<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">Galery</h1>
  </div>
</section>


<div class="columns">
    <div class="column"></div>
    <div class="column is-640">
        <div class="columns is-multiline">
            <?php foreach ($posts as $post): ?>
            <div class="column is-full">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            <?= $post->username; ?>
                        </p>
                    </header>
                    <div class="card-image">
                        <figure class="image is-full">
                            <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content level">
                            <div class="level-left">
                                <span class="icon has-text-info">
                                    <a href="<?= 'index.php?p=view_post&id='.$post->id_post; ?>">
                                        <i style="cursor: pointer" class="far fa-comment fa-lg"></i>
                                    </a>
                                </span>
                            <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
                                <span class="icon has-text-danger">
                                    <i style="cursor: pointer" id_post="<?= $post->id_post; ?>" class="like_btn far fa-heart fa-lg"></i>
                                </span>
                            <?php } ?>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <p class="subtitle is-6 has-text-weight-bold" id_post_show_likes="<?= $post->id_post; ?>"><?= $post->likes_count ? $post->likes_count : 0; ?></p>
                                </div>
                                <div class="level-item">
                                    <p class="subtitle is-6 has-text-weight-semibold">likes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="column"></div>
</div>
<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/galery.js"></script>

<div id="message" style="color:red;"></div>




<!-- <div class="post_container">
    <div class="post_header">
        <p><?= $post->username; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
    <div class="post_footer">
    <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
        <button class="like_btn" id_post="<?= $post->id_post; ?>">Like</button>
    <?php } ?>
        <a href="<?= 'index.php?p=view_post&id='.$post->id_post; ?>">View comments</a>
        <div class="likes">
            <p id_post_show_likes="<?= $post->id_post; ?>"><?= $post->likes_count ? $post->likes_count : 0; ?></p>
            <p> likes</p>
        </div>
    </div>
</div> -->