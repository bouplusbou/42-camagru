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
        <div id="posts_container" class="columns is-multiline">
            <?php foreach ($posts as $post): ?>
            <div class="column is-full">
                <div offset="<?= $offset += 1?>" class="card">
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
                        <div class="content">
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <span class="icon has-text-info comment_icon" style="margin: 0 10px 0 0;">
                                            <a href="<?= 'index.php?p=view_post&id='.$post->id_post; ?>">
                                                <i style="cursor: pointer" class="far fa-comment fa-lg"></i>
                                            </a>
                                        </span>
                                        <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
                                        <span class="icon has-text-danger">
                                            <i style="cursor: pointer" id_post="<?= $post->id_post; ?>" class="like_btn <?= $post->user_liked ? 'fas fa-heart fa-lg' : 'far fa-heart fa-lg'?>"></i>
                                        </span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <p class="subtitle is-6 has-text-weight-bold" id_post_show_likes="<?= $post->id_post; ?>"><?= $post->likes_count ? $post->likes_count : 0; ?></p>
                                    </div>
                                    <div class="level-item">
                                        <p class="subtitle is-6 has-text-weight-semibold"><?= $post->likes_count == '1' ? 'like' : 'likes'; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if ($post->commenter) { ?>
                            <div class="level-left">
                                <p><b><?= $post->commenter; ?></b>   <?= $post->comment; ?></p>
                            </div>
                            <div class="level" style="margin-top: 10px;">
                                <div class="level-left">
                                    <a class="title is-size-7 has-text-weight-bold has-text-grey-lighter" href="<?= 'index.php?p=view_post&id='.$post->id_post; ?>">View all comments</a>
                                </div>
                            </div>
                            <?php } ?>  
                        </div>
                    </div>
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
                    <footer class="card-footer">
                        <nav class="card-footer-item">
                            <div class="field has-addons">
                                <p class="control">
                                    <input input_id_post="<?= $post->id_post; ?>" class="input is-small comment_input" type="text" placeholder="Add a new comment">
                                </p>
                                <p class="control">
                                    <a class="button is-info is-outlined is-small comment_btn" id_post="<?= $post->id_post; ?>">
                                    Comment
                                    </a>
                                </p>
                            </div>
                        </nav>
                    </footer>
                    <?php } ?>  
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="column"></div>
</div>
<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/galery.js"></script>

