<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<h1>View Post <?= $id_post ?></h1>

<div class="post_container">
    <div class="post_header">
        <p><?= $post['username']; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$post['photo_name']; ?>" alt="">
    <div class="post_footer">
    <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
        <button id="like_btn" id_post="<?= $post['id_post']; ?>">Like</button>
    <?php } ?>
        <div class="likes">
            <p id_post_show_likes="<?= $post['id_post']; ?>"><?= $post['likes_count'] ? $post['likes_count'] : 0; ?></p>
            <p> Likes</p>
        </div>
        <div id="comments_container">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <b><?= $comment['username']; ?></b>
                <p> <?= $comment['comment']; ?></p>
            </div>
        <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
		<input placeholder="Type your comment here..." type="text" value="" name="comment" id="comment_input" />
		<input type="submit" value="comment" name="submit" id="comment_btn" id_user="<?= $_SESSION['id_user']; ?>" id_post="<?= $post['id_post']; ?>" id_post_creator="<?= $post['id_user']; ?>" />
        <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
        <?php } ?>
    </div>
</div>

<div id="message" style="color:red;"></div>

<?php if (isset($_SESSION['username'])) { ?>
<script type="text/javascript">
    let currentUsername = "<?= $_SESSION['username']; ?>";
</script>
<script type="text/javascript" src="./app/assets/js/viewPost.js"></script>
<?php } ?>
