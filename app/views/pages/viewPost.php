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
		<input type="submit" value="comment" name="submit" id="comment_btn" id_user="<?= $_SESSION['id_user']; ?>" id_post="<?= $post['id_post']; ?>" />
        <?php } ?>
    </div>
</div>

<div id="message" style="color:red;"></div>

<?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
<script type="text/javascript">
    let currentUsername = "<?= $_SESSION['username']; ?>";
    let currentUserID = "<?= $_SESSION['id_user']; ?>";
    </script>
<script type="text/javascript" src="./app/assets/js/viewPost.js"></script>
<?php } ?>
