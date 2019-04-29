<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">Post</h1>
  </div>
</section>

<div class="columns">
<div class="column"></div>
<div class="column is-half">
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                <?= $post['username']; ?>
            </p>
        </header>
        <div class="card-image">
            <figure class="image is-full">
                <img src="<?= './app/assets/images/post_img/'.$post['photo_name']; ?>" alt="">
            </figure>
        </div>
        <div class="card-content">
            <div id="comments_container" class="content">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <span id="comment_icon" class="icon has-text-info">
                                <a><i style="cursor: pointer" class="far fa-comment fa-lg"></i></a>
                            </span>
                            <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
                            <span class="icon has-text-danger">
                                <i style="cursor: pointer" id="like_btn" id_post="<?= $post['id_post']; ?>" class="like_btn <?= $user_liked ? 'fas fa-heart fa-lg' : 'far fa-heart fa-lg'?>"></i>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item has-text-weight-bold">
                            <p id_post_show_likes="<?= $post['id_post']; ?>"><?= $post['likes_count'] ? $post['likes_count'] : 0; ?></p>
                        </div>
                        <div class="level-item">
                            <p class="subtitle is-6 has-text-weight-semibold"><?= $post['likes_count'] == '1' ? 'like' : 'likes'; ?></p>
                        </div>
                    </div>
                </div>
                <?php foreach ($comments as $comment): ?>
                <div class="level-left">
                    <p><b><?= $comment['username']; ?></b>   <?= $comment['comment']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <footer class="card-footer">
            <nav class="card-footer-item">
                <div class="field has-addons">
                <p class="control">
                    <input id="comment_input" class="input is-small" type="text" placeholder="Add a new comment">
                </p>
                <p class="control">
                    <a class="button is-info is-small" id="comment_btn" id_post="<?= $post['id_post']; ?>">
                    Comment
                    </a>
                </p>
                </div>
            </nav>
        </footer>
    </div>
</div>
<div class="column"></div>
</div>



<input type="hidden" name="token" id="token" value="<?= $token; ?>" />


<?php if (isset($_SESSION['username'])) { ?>
<script type="text/javascript">
    let currentUsername = "<?= $_SESSION['username']; ?>";
</script>
<script type="text/javascript" src="./app/assets/js/viewPost.js"></script>
<?php } ?>
