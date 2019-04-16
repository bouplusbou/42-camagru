<h1>View Post <?= $id_post ?></h1>

<div class="post_container">
    <div class="post_header">
        <p><?= $post['username']; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$post['photo_name']; ?>" alt="">
    <div class="post_footer">
        <a href="">Like</a>
        <a href="<?= 'index.php?p=viewPost&id='.$post['id_post']; ?>">Comment</a>
        <p>1540 Likes</p>
        <div id="comments_container">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <b><?= $comment['username']; ?></b>
                <p> <?= $comment['comment']; ?></p>
            </div>
        <?php endforeach; ?>
        </div>
		<input placeholder="Type your comment here..." type="text" value="" name="comment" id="comment_input" />
		<input type="submit" value="comment" name="submit" id="comment_btn" id_user="<?= $_SESSION['id_user']; ?>" id_post="<?= $post['id_post']; ?>" />
    </div>
</div>

<div id="message" style="color:red;"></div>

<script type="text/javascript">
<?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
    let currentUsername = "<?= $_SESSION['username']; ?>";
    let currentUserID = "<?= $_SESSION['id_user']; ?>";
<?php } ?>
</script>
<script type="text/javascript" src="./app/assets/js/viewPost.js"></script>
